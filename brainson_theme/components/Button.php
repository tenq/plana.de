<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class Button extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = true;


    public static function getComponentName(): string
    {
        return 'button';
    }

    public static function getComponentLabel(): string
    {
        return 'Button';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/button.twig';
    }

    public function defineFields(): array
    {
        $globalFields = $this->isNested ? ['margin_top'] : ['margin_top', 'alternate_background', 'padding_top', 'padding_bottom', 'container_width'];

        return [
            'key' => 'content_component_ctabutton',
            'name' => $this->getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields($globalFields),
                [
                    array(
                        'key' => 'field_61a8d72f36241',
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
                    ),
                    array(
                        'key' => 'field_61a8d72f36280',
                        'label' => 'Buttons',
                        'name' => 'buttons',
                        'type' => 'repeater',
                        'required' => 1,
                        'layout' => 'table',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_61a8d72f362bc',
                                'label' => 'Link',
                                'name' => 'link',
                                'type' => 'link',
                                'required' => 1,
                                'wrapper' => array(
                                    'width' => '50%',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'return_format' => 'array',
                            ),
                            array(
                                'key' => 'field_61a8d72f362f7',
                                'label' => 'Button Stil',
                                'name' => 'style',
                                'type' => 'select',
                                'wrapper' => array(
                                    'width' => '50%',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'choices' => array(
                                    'primary' => 'Primär',
                                    'link' => 'Link',
                                ),
                                'default_value' => 'primary',
                                'return_format' => 'value',
                            ),
                        ),
                    ),
                ],
                $this->defineGlobalFields(['uniqueid'])
            )
        ];
    }
}
