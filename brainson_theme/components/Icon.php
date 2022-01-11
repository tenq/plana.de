<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class Icon extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = true;

    public static $mainLevel = false;

    public static function getComponentName(): string
    {
        return 'icon';
    }

    public static function getComponentLabel(): string
    {
        return 'Icon';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/icon.twig';
    }

    public function defineFields(): array
    {
        return [

            'key' => 'content_component_icon',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields(['margin_top']),
                [
                    array(
                        'key' => 'field_5f9a88fc51234',
                        'label' => 'Icon',
                        'name' => 'icon',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 1,
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
                    ),
                    array(
                        'key' => 'field_5ece4797e2345',
                        'label' => 'Horizontale Ausrichtung',
                        'name' => 'alignment',
                        'type' => 'button_group',
                        'choices' => array(
                            'left' => 'linksbündig',
                            'center' => 'zentriert',
                            'right' => 'rechtsbündig',
                        ),
                        'wrapper' => array(
                            'width' => '50',
                        ),
                        'allow_null' => 0,
                        'default_value' => 'left',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                ],
                $this->defineGlobalFields(['uniqueid'])
            )
        ];
    }
}
