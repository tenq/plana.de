<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class Infobox extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = false;

    public static function getComponentName(): string
    {
        return 'infobox';
    }

    public static function getComponentLabel(): string
    {
        return 'Infobox';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/infobox.twig';
    }

    public function defineFields(): array
    {
        return [

            'key' => 'content_component_infobox',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields(['margin_top', 'container_width']),
                [
                    [
                        'key' => 'field_615ea65ccbe8b',
                        'label' => 'Horizontale Ausrichtung',
                        'name' => 'alignment',
                        'type' => 'button_group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'choices' => [
                            'justify-start' => 'Linksbündig',
                            'justify-center' => 'Zentriert',
                            'justify-end' => 'Rechtsbündig',
                        ],
                        'allow_null' => 0,
                        'default_value' => 'justify-start',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ],
                    [
                        'key' => 'field_615ea6eecbe8c',
                        'label' => 'Icon',
                        'name' => 'icon',
                        'type' => 'button_group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '50%',
                            'class' => '',
                            'id' => '',
                        ],
                        'choices' => [
                            'info-light-bulb' => $this->getIconSVG('info-light-bulb'),
                            'info-warning' => $this->getIconSVG('info-warning'),
                        ],
                        'allow_null' => 0,
                        'default_value' => 'info-light-bulb',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ],
                    [
                        'key' => 'field_615ea9fdcbe8f',
                        'label' => 'Icon Style',
                        'name' => 'icon_style',
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
                            'rounded-none' => 'Normal',
                            'rounded-full' => 'Abgerundet',
                        ],
                        'default_value' => 'rounded-none',
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'return_format' => 'value',
                        'ajax' => 0,
                        'placeholder' => '',
                    ],
                    [
                        'key' => 'field_615ea734cbe8d',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                    ],
                    [
                        'key' => 'field_615ea749cbe8e',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'default_value' => '',
                        'placeholder' => '',
                        'maxlength' => '',
                        'rows' => '',
                        'new_lines' => '',
                    ]
                ],
                $this->defineGlobalFields(['uniqueid'])
            )
        ];
    }

    private function getIconSVG($iconName): string
    {
        $svg = '<svg height="25" width="25"><use xlink:href="%s/assets/dist/svg/sprite.svg#icon-%s"></use></svg>';
        return sprintf($svg, get_template_directory_uri(), $iconName);
    }
}
