<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class Accordion extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = true;

    public static function getComponentName(): string
    {
        return 'accordion';
    }

    public static function getComponentLabel(): string
    {
        return 'Akkordeon';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ .'/../templates/components/accordion.twig';
    }

    public function defineFields(): array
    {
        $globalFields = $this->isNested ? ['margin_top'] : ['margin_top', 'container_width'];

        return [

            'key' => 'content_component_accordion',
            'name' => $this->getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields($globalFields),
                [
                    [
                        'key' => 'field_615d6fb86d92d',
                        'label' => 'Als FAQ auszeichnen?',
                        'name' => 'show_faq_schema',
                        'type' => 'true_false',
                        'instructions' => 'Sollen die Akkordeon als FAQs in schema.org ausgezeichnen werden?',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ],
                    [
                        'key' => 'field_615d702b6d92e',
                        'label' => 'Titel & Inhalte',
                        'name' => 'items',
                        'type' => 'repeater',
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
                                'key' => 'field_615d709d6d92f',
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
                                'key' => 'field_615d70ca6d930',
                                'label' => 'Inhalt',
                                'name' => 'content',
                                'type' => 'wysiwyg',
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
                                'key' => 'field_615d711f6d931',
                                'label' => 'Geöffnet',
                                'name' => 'initiallyOpened',
                                'type' => 'true_false',
                                'instructions' => 'Gibt an, ob das Item beim Seitenaufruf geöffnet oder geschlossen dargestellt werden soll.',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'message' => '',
                                'default_value' => 0,
                                'ui' => 0,
                                'ui_on_text' => '',
                                'ui_off_text' => '',
                            ],
                        ],
                    ]
                ],
                $this->defineGlobalFields(['uniqueid'])
            )
        ];
    }
}