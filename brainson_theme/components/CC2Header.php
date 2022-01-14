<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class CC2Header extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = false;

    public static function getComponentName(): string
    {
        return 'cc2header';
    }

    public static function getComponentLabel(): string
    {
        return 'Header';
    }

    public static function phone($phone): string
    {
        return preg_replace('![^0-9]+!', '', $phone);
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/cc2header.twig';
    }

    public function defineFields(): array
    {
        $globalFields = $this->isNested ? ['container_width'] : ['container_width'];

        return [
            'key' => 'content_component_cc2header',
            'name' => $this->getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields($globalFields),
                [
                    [
                        'key' => 'field_615d702b62454',
                        'label' => 'Header',
                        'name' => 'header',
                        'type' => 'group',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'collapsed' => '',
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'row',
                        'button_label' => '',
                        'sub_fields' => [
                            [
                                'key' => 'field_615d6fb86d92c',
                                'label' => 'Logo',
                                'name' => 'logo',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'default_value' => '',
                                'ui' => 0,
                                'ui_on_text' => '',
                                'ui_off_text' => '',

                            ],
                            [
                                'key' => 'field_615d6fb86d93h',
                                'label' => 'Telefonnummer',
                                'name' => 'phone',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'default_value' => '',
                                'ui' => 0,
                                'ui_on_text' => '',
                                'ui_off_text' => '',

                            ],
                            [
                                'key' => 'field_615d6fb86d98i',
                                'label' => 'Ankertitel',
                                'name' => 'anchor_title',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'default_value' => '',
                                'ui' => 0,
                                'ui_on_text' => '',
                                'ui_off_text' => '',

                            ],
                            [
                                'key' => 'field_615d6fb86d97k',
                                'label' => 'Anker (block id)',
                                'name' => 'anchor',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'default_value' => '',
                                'ui' => 0,
                                'ui_on_text' => '',
                                'ui_off_text' => '',

                            ],
                        ],
                    ],
                    [
                        'key' => 'field_615d702b6d92r',
                        'label' => 'Inhalt',
                        'name' => 'items',
                        'type' => 'group',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'collapsed' => '',
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'row',
                        'button_label' => '',
                        'sub_fields' => [
                            [
                                'key' => 'field_615d709d6d456',
                                'label' => 'Titel',
                                'name' => 'title',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ],
                            [
                                'key' => 'field_615d70ca6d938',
                                'label' => 'Text',
                                'name' => 'text',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'default_value' => '',
                                'tabs' => 'text',
                                'media_upload' => 0,
                                'toolbar' => 'basic',
                                'delay' => 0,
                            ],
                            [
                                'key' => 'field_615d70ca6d457',
                                'label' => 'Hintergrundbild',
                                'name' => 'bg',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'default_value' => '',
                                'tabs' => 'text',
                                'media_upload' => 0,
                                'toolbar' => 'basic',
                                'delay' => 0,
                            ],
                            [
                                'key' => 'field_615d70ca6f456',
                                'label' => 'Name',
                                'name' => 'name',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'default_value' => '',
                                'tabs' => 'text',
                                'media_upload' => 0,
                                'toolbar' => 'basic',
                                'delay' => 0,
                            ],
                            [
                                'key' => 'field_615d70ca6s234',
                                'label' => 'Firma',
                                'name' => 'firm',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'default_value' => '',
                                'tabs' => 'text',
                                'media_upload' => 0,
                                'toolbar' => 'basic',
                                'delay' => 0,
                            ],
                            [
                                'key' => 'field_615d70ca6adw3',
                                'label' => 'Tasten',
                                'name' => 'btns',
                                'type' => 'group',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'default_value' => '',
                                'tabs' => 'text',
                                'media_upload' => 0,
                                'toolbar' => 'basic',
                                'delay' => 0,
                                'sub_fields' => [
                                    [
                                        'key' => 'field_615d709d6sf45',
                                        'label' => 'Taste 1 titel',
                                        'name' => 'btn1_title',
                                        'type' => 'text',
                                        'instructions' => '',
                                        'required' => 1,
                                        'conditional_logic' => 0,
                                        'default_value' => '',
                                        'placeholder' => '',
                                        'prepend' => '',
                                        'append' => '',
                                        'maxlength' => '',
                                    ],
                                    [
                                        'key' => 'field_615d709d6sd33',
                                        'label' => 'Taste 1 anker (block id)',
                                        'name' => 'btn1_anchor',
                                        'type' => 'text',
                                        'instructions' => '',
                                        'required' => 1,
                                        'conditional_logic' => 0,
                                        'default_value' => '',
                                        'placeholder' => '',
                                        'prepend' => '',
                                        'append' => '',
                                        'maxlength' => '',
                                    ],
                                    [
                                        'key' => 'field_615d709d6we56',
                                        'label' => 'Taste 2 titel',
                                        'name' => 'btn2_title',
                                        'type' => 'text',
                                        'instructions' => '',
                                        'required' => 1,
                                        'conditional_logic' => 0,
                                        'default_value' => '',
                                        'placeholder' => '',
                                        'prepend' => '',
                                        'append' => '',
                                        'maxlength' => '',
                                    ],
                                    [
                                        'key' => 'field_615d709dfgh56',
                                        'label' => 'Taste 2 anker (block id)',
                                        'name' => 'btn2_anchor',
                                        'type' => 'text',
                                        'instructions' => '',
                                        'required' => 1,
                                        'conditional_logic' => 0,
                                        'default_value' => '',
                                        'placeholder' => '',
                                        'prepend' => '',
                                        'append' => '',
                                        'maxlength' => '',
                                    ],
                                ]
                            ],
                        ],
                    ],
                    [
                        'key' => 'field_615d702b6zdv4',
                        'label' => 'Vorteile',
                        'name' => 'benefits',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'collapsed' => '',
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'table',
                        'button_label' => '',
                        'sub_fields' => [
                            [
                                'key' => 'field_615d709d6adf4',
                                'label' => 'Text',
                                'name' => 'text',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ],
                            [
                                'key' => 'field_615ea9fdcbe8f',
                                'label' => 'Icon',
                                'name' => 'icon',
                                'type' => 'select',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => [
                                    'width' => '50%',
                                    'class' => '',
                                    'id' => '',
                                ],
                                'choices' => [
                                    'icon_beste-aussichten' => 'Uhr',
                                    'icon_an-ihrer-seite' => 'Menschen',
                                    'icon_mach-dein-ding' => 'Blöcke',
                                ],
                                'default_value' => 'rounded-none',
                                'allow_null' => 0,
                                'multiple' => 0,
                                'ui' => 0,
                                'return_format' => 'value',
                                'ajax' => 0,
                                'placeholder' => '',
                            ],
                        ],
                    ],
                ],
                $this->defineGlobalFields(['uniqueid'])
            ),
        ];
    }


}