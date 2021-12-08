<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class MultiColumns extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $hasNestedLevel = true;

    public static function getComponentName(): string
    {
        return 'multicolumns';
    }

    public static function getComponentLabel(): string
    {
        return 'Mehrspalter';
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
        $this->slots['slot3'] = new \Brainson\Scaffold\Slot($this->getComponentName() . '_3', 'Sub-Komponenten', true);
        $this->slots['slot4'] = new \Brainson\Scaffold\Slot($this->getComponentName() . '_4', 'Sub-Komponenten', true);
    }



    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/multi-columns.twig';
    }

    public function defineFields(): array
    {

        return [

            'key' => 'content_component_multicolumns',
            'name' => $this->getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                [
                    array(
                        'key' => 'field_6183ef3b45fd6',
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
                        'key' => 'field_6183f03f717d4',
                        'label' => 'Spalten',
                        'name' => 'columns',
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
                            'two' => '2',
                            'three' => '3',
                            'four' => '4',
                        ),
                        'allow_null' => 0,
                        'default_value' => 'two',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_6183efc105081',
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
                            'stretch' => $this->getIconSVG('admin-columns-2') . 'Stretch',
                        ),
                        'allow_null' => 0,
                        'default_value' => 'top',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_6183f5ac7d108',
                        'label' => 'Invertierte Reihenfolge',
                        'name' => 'inverted',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => 'Reihenfolge der Spalten umkehren, sodass die letzte Spalte zuerst angezeigt wird.',
                        'default_value' => 0,
                    ),
                    array(
                        'key' => 'field_6183efc8c0dc8',
                        'label' => 'Spaltenaufteilung',
                        'name' => 'weighting',
                        'type' => 'button_group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_6183f03f717d4',
                                    'operator' => '==',
                                    'value' => 'two',
                                ),
                            ),
                        ),
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
                        'key' => 'field_6183efd0c2c2b',
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
                        'key' => 'field_6183efd9b1824',
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
                        'key' => 'field_6183efe1d91d8',
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
                        'key' => 'field_6183efe9238c6',
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
                    array(
                        'key' => 'field_6183f1416f250',
                        'label' => 'Spalte 3',
                        'name' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_6183f03f717d4',
                                    'operator' => '==',
                                    'value' => 'three',
                                ),
                            ),
                            array(
                                array(
                                    'field' => 'field_6183f03f717d4',
                                    'operator' => '==',
                                    'value' => 'four',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'left',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_6183f152af3e3',
                        'label' => 'Sub-Komponenten',
                        'name' => 'column3',
                        'type' => 'flexible_content',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layouts' => $this->slots['slot3']->getRegisteredComponentsFieldDefinition(),
                        'button_label' => 'Sub-Komponente hinzufügen',
                        'min' => '',
                        'max' => '',
                    ),
                    array(
                        'key' => 'field_6183f2b0b212d',
                        'label' => 'Spalte 4',
                        'name' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_6183f03f717d4',
                                    'operator' => '==',
                                    'value' => 'four',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'left',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_6183f2b822c8c',
                        'label' => 'Sub-Komponenten',
                        'name' => 'column4',
                        'type' => 'flexible_content',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layouts' => $this->slots['slot4']->getRegisteredComponentsFieldDefinition(),
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
