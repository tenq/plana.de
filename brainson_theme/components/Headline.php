<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class Headline extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = true;


    public static function getComponentName(): string
    {
        return 'headline';
    }

    public static function getComponentLabel(): string
    {
        return 'Headline';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/headline.twig';
    }

    public function defineFields(): array
    {
        $globalFields = $this->isNested ? ['margin_top'] : ['margin_top', 'alternate_background', 'padding_top', 'padding_bottom', 'container_width'];

        return [

            'key' => 'content_component_headline',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields($globalFields),
                [
                    array(
                        'key' => 'field_5f89aa14ebe1b',
                        'label' => 'Ebene',
                        'name' => 'level',
                        'type' => 'button_group',
                        'choices' => array(
                            'h1' => 'H1',
                            'h2' => 'H2',
                            'h3' => 'H3',
                            'h4' => 'H4',
                        ),
                        'wrapper' => array(
                            'width' => '50',
                        ),
                        'allow_null' => 0,
                        'default_value' => 'h2',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5f89aa1412345',
                        'label' => 'Topline position',
                        'name' => 'topline_position',
                        'type' => 'button_group',
                        'choices' => array(
                            'top' => 'Top',
                            'bottom' => 'Boden',
                        ),
                        'wrapper' => array(
                            'width' => '50',
                        ),
                        'allow_null' => 0,
                        'default_value' => 'h2',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5ece4797eaf5e',
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
                    array(
                        'key' => 'field_5fad59d823e8c',
                        'label' => 'Topline',
                        'name' => 'topline',
                        'type' => 'text',
                        'wrapper' => array(
                            'width' => '',
                        ),
                        'required' => 0,
                        'conditional_logic' => 0,
                    ),
                    array(
                        'key' => 'field_5f89aa54ebe1c',
                        'label' => 'Text',
                        'name' => 'heading',
                        'type' => 'text',
                        'wrapper' => array(
                            'width' => '',
                        ),
                        'required' => 1,
                        'conditional_logic' => 0,
                    ),
                ],
                $this->defineGlobalFields(['uniqueid'])
            )
        ];
    }
}
