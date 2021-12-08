<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class TwoColumns extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $hasNestedLevel = true;

    public static function getComponentName(): string
    {
        return 'twocolumns';
    }

    public static function getComponentLabel(): string
    {
        return 'Zwei Spalten';
    }

    public $slots = [];

    public function __construct()
    {
        $this->registerSlots();
    }

    public function registerSlots()
    {
        $this->slots['slot1'] = new \Brainson\Scaffold\Slot($this->getComponentName() . '_1', 'Sub-Komponenten', true);
        $this->slots['slot2'] = new \Brainson\Scaffold\Slot($this->getComponentName() . '_2', 'Sub-Komponenten', true);
    }



    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/two-columns.twig';
    }

    public function defineFields(): array
    {

        return [

            'key' => 'content_component_twocolumns',
            'name' => $this->getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                [
                    array(
                        'key' => 'field_5f899e6ac615e',
                        'label' => 'Darstellung',
                        'name' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'left',
                        'endpoint' => 0,
                    ),
                ],
                $this->defineGlobalFields(['margin_top', 'alternate_background', 'padding_top', 'padding_bottom', 'container_width']),
                [
                    array(
                        'key' => 'field_5f899e96c615f',
                        'label' => 'Vertikale Ausrichtung',
                        'name' => 'v_alignment',
                        'type' => 'button_group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'top' => $this->getIconSVG('admin-valign-top') . 'Oben',
                            'center' => $this->getIconSVG('admin-valign-middle') . 'Mittig',
                            'bottom' => $this->getIconSVG('admin-valign-bottom') . 'Unten',
                        ),
                        'allow_null' => 0,
                        'default_value' => 'top',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5f899eeac6160',
                        'label' => 'Spaltenaufteilung',
                        'name' => 'weighting',
                        'type' => 'button_group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'two-one' => $this->getIconSVG('admin-weighting-2-1') . '66:33',
                            'three-two' => $this->getIconSVG('admin-weighting-3-2') . '60:40',
                            'one-one' => $this->getIconSVG('admin-weighting-1-1') . '50:50',
                            'two-three' => $this->getIconSVG('admin-weighting-2-3') . '40:60',
                            'one-two' => $this->getIconSVG('admin-weighting-1-2') . '33:66',
                        ),
                        'allow_null' => 0,
                        'default_value' => 'one-one',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                ],
                $this->defineGlobalFields(['uniqueid']),
                [
                    array(
                        'key' => 'field_5f899e36c615c',
                        'label' => 'Spalte 1',
                        'name' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'left',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_5f89864f30056',
                        'label' => 'Sub-Komponenten',
                        'name' => 'column1',
                        'type' => 'flexible_content',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layouts' => $this->slots['slot1']->getRegisteredComponentsFieldDefinition(),
                        'button_label' => 'Sub-Komponente hinzufügen',
                        'min' => '',
                        'max' => '',
                    ),
                    array(
                        'key' => 'field_5f899e13c615b',
                        'label' => 'Spalte 2',
                        'name' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'left',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_5f89867fb700b',
                        'label' => 'Sub-Komponenten',
                        'name' => 'column2',
                        'type' => 'flexible_content',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layouts' => $this->slots['slot2']->getRegisteredComponentsFieldDefinition(),
                        'button_label' => 'Sub-Komponente hinzufügen',
                        'min' => '',
                        'max' => '',
                    ),
                ]
            )
        ];
    }

    public function getAlignmentClass()
    {
        return $this->data['alignment'] == 'image_left' ? 'left' : 'right';
    }
}
