<?php

namespace Brainson\Scaffold;

use DirectoryIterator;
use Exception;
use Throwable;
use function apply_filters;
use function get_field;
use function acf_add_local_field_group;

class Slot
{

    /**
     * @var array
     */
    private $registry = [];

    /**
     * @var string
     */
    private $level = 'main';

    /**
     * @var string
     */
    private $name = 'main';

    /**
     * @var string
     */
    private $label = '';

    /**
     * @var string
     */
    private $content_components_dir = __DIR__ . '/components';

    /**
     * @var array
     */
    private $post_types = ['post', 'page'];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Slot constructor.
     * @param $name
     * @param $label
     * @param $nestedLevel
     * @throws Exception
     */
    public function __construct($name, $label, $nestedLevel)
    {
        $this->name = $name;
        $this->label = $label;
        $this->level = $nestedLevel ? 'nested' : 'main';
        # FIXME Warum mit Parameter, Funktion den gar nicht
        $this->registerComponentsFromFolder($nestedLevel);

        // if slot is on main level register acf fieldgroup
        if (!$nestedLevel) $this->registerACFFieldgroup();
    }

    /**
     * @param $component_name
     * @param $component_class
     */
    public function registerContentComponent($component_name, $component_class)
    {
        $this->registry[$component_name] = $component_class;
    }

    /**
     * @return array
     */
    public function getRegisteredComponents()
    {
        return $this->registry;
    }

    /**
     * @return array
     */
    public function getRegisteredComponentsFieldDefinition()
    {
        $layouts = [];

        foreach ($this->registry as $component) {
            if ($component::$isNestable === true) {
                $layouts[$component::getComponentName()] = $component->defineFields();
            };
        }

        return $layouts;
    }

    /**
     * @param $component_name
     * @return mixed
     */
    public function getRegisteredComponent($component_name)
    {
        return $this->registry[$component_name];
    }

    /**
     * @param $component_name
     * @return bool
     */
    public function isComponentRegistered($component_name): bool
    {
        return array_key_exists($component_name, $this->registry);
    }

    /**
     * @throws Exception
     */
    public function registerComponentsFromFolder()
    {
        foreach (new DirectoryIterator($this->content_components_dir) as $fileInfo) {
            if ($fileInfo->isDot()) continue;
            if ($fileInfo->isFile()) {

                $class_name = '\Brainson\Scaffold\ContentComponents\\' . $fileInfo->getBasename('.php');


                // Check if Component is not nestable and nested
                if ($class_name::$isNestable && $class_name::$hasNestedLevel) {
                    throw new Exception('Component ' . $class_name . ' cannot be nestable and have a nested level');
                } else {

                    if (!($class_name::$hasNestedLevel && $this->level == 'nested')) {
                        $component = new $class_name();
                        if ($this->level == 'nested') $component->isNested = true;
                        $this->registerContentComponent($component->getComponentName(), $component);
                    }
                }
            }
        }
    }

    /**
     *
     */
    public function registerACFFieldgroup()
    {
        $layouts = [];
        $locations = [];

        // Sort registry by label before adding to fieldgroup for better readability
        uasort($this->registry, function ($a, $b) {
            return strcmp(strtolower($a->getComponentLabel()),  strtolower($b->getComponentLabel()));
        });

        foreach ($this->registry as $component) {
            // Check if component is usable on main level
            if ($component::$mainLevel === true) {
                $layouts[$component->getComponentName()] = $component->defineFields();
            }
        }

        //Prepare Location Definition
        foreach ($this->post_types as $location) {
            $locations[] = [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => $location,
                ]
            ];
        }

        try {
            acf_add_local_field_group([
                'key' => 'scaffold_fieldgroup_' . $this->name,
                'title' => 'Scaffold Fieldgroup',
                'fields' => [
                    [
                        'key' => 'scaffold_' . $this->name,
                        'label' => $this->label,
                        'name' => 'scaffold_' . $this->name,
                        'type' => 'flexible_content',
                        'layouts' => $layouts,
                        'button_label' => 'Komponente hinzufügen',
                    ]
                ],
                'location' => $locations,
                'style' => 'seamless',
                'active' => true,
            ]);
        } catch (Throwable $e) {
            error_log($e->getMessage());
        }
    }

    /**
     * @param $nestedLayouts
     */
    public function renderComponents($nestedLayouts, $postID, $parentObject = null)
    {

        if (isset($nestedLayouts)) {
            $fields = $nestedLayouts;
            $isNested = true;
        } else {
            $fields = get_field('scaffold_' . $this->name, $postID);
            $isNested = false;
        }

        if ($fields) {

            foreach ($fields as $field) {

                if (isset($field['acf_fc_layout']) && $this->isComponentRegistered($field['acf_fc_layout'])) {
                    $component = $this->getRegisteredComponent($field['acf_fc_layout']);
                    $component = new $component();
                    $component->isNested = $isNested;
                    $component->parentObject = $parentObject;
                    $component->slotName = $this->name;

                    $component->prepareData($field);


                    //Render Output and apply functions of `scaffold_content_component_output` filter hook
                    echo apply_filters('scaffold_content_component_output', $component->renderOutput(), $component);
                }
            }
        }
    }
}
