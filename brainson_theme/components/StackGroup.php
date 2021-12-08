<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class StackGroup extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = false;
    public static $mainLevel = true;

    public static function getComponentName(): string
    {
        return 'stackgroup';
    }

    public static function getComponentLabel(): string
    {
        return 'Stack Group';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/stack-group.twig';
    }

    public function defineFields(): array
    {
        return [

            'key' => 'content_component_stackgroup',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields(['margin_top', 'alternate_background', 'padding_top', 'padding_bottom', 'container_width']),
                [
                    [
                        'key' => 'field_5fb7ed6fb7323',
                        'label' => 'Spaltenanzahl',
                        'name' => 'column_amount',
                        'type' => 'button_group',
                        'wrapper' => [
                            'width' => '50'
                        ],
                        'choices' => [
                            'three' => $this->getIconSVG('admin-columns-3') . '3',
                            'four' => $this->getIconSVG('admin-columns-4') . '4',
                            'five' => $this->getIconSVG('admin-columns-5') . '5',
                        ],
                        'allow_null' => 0,
                        'default_value' => 'three',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ],
                    [
                        'key' => 'field_5fb7eda6b7324',
                        'label' => 'Ausrichtung',
                        'name' => 'alignment',
                        'type' => 'button_group',
                        'wrapper' => [
                            'width' => '50'
                        ],
                        'choices' => [
                            'left' => $this->getIconSVG('admin-textalign-left') . 'Links',
                            'center' => $this->getIconSVG('admin-textalign-center') . 'Mittig',
                        ],
                        'default_value' => 'center',
                    ],
                    [
                        'key' => 'field_5fb7ede9b7325',
                        'label' => 'Items',
                        'name' => 'items',
                        'type' => 'repeater',
                        'required' => 1,
                        'layout' => 'table',
                        'sub_fields' => [
                            [
                                'key' => 'field_5fb7ee30b7326',
                                'label' => 'Bild',
                                'name' => 'image',
                                'type' => 'image',
                                'return_format' => 'ID',
                                'preview_size' => 'square_small',
                            ],
                            [
                                'key' => 'field_5fb7ee44b7327',
                                'label' => 'Titel',
                                'name' => 'title',
                                'type' => 'text'
                            ],
                            [
                                'key' => 'field_5fb7ee52b7328',
                                'label' => 'Text',
                                'name' => 'body',
                                'type' => 'textarea'
                            ],
                            [
                                'key' => 'field_5fb7ed6fb7324',
                                'label' => 'Stil',
                                'name' => 'style',
                                'type' => 'button_group',
                                'choices' => [
                                    'round' => 'Rund',
                                    'square' => 'Eckig',
                                ],
                                'allow_null' => 0,
                                'default_value' => 'three',
                                'layout' => 'horizontal',
                                'return_format' => 'value',
                            ],
                        ],
                    ],
                ],
                $this->defineGlobalFields(['uniqueid'])
            )
        ];
    }
}
