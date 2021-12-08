<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class CTABox extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = true;


    public static function getComponentName(): string
    {
        return 'ctabox';
    }

    public static function getComponentLabel(): string
    {
        return 'CTA Box';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/cta-box.twig';
    }

    public function defineFields(): array
    {
        $globalFields = $this->isNested ? ['margin_top'] : ['margin_top', 'container_width'];

        return [

            'key' => 'content_component_ctabox',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields($globalFields),
                [
                    array(
                        'key' => 'field_61a9df2eedde9',
                        'label' => 'Volle Breite',
                        'name' => 'full_width',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                        ),
                        'message' => 'Soll die CTA Box auf die komplette Bildschirm-Breite gezogen werden? (Funktioniert nicht im Mehrspalter)',
                        'default_value' => 0,
                    ),
                    array(
                        'key' => 'field_61a9eb6029203',
                        'label' => 'Horizontale Ausrichtung',
                        'name' => 'alignment',
                        'type' => 'button_group',
                        'instructions' => 'Definiert die horizontale Ausrichtung der Text-Elemente. Die Ausrichtung des Bildes wird nicht verändert.',
                        'choices' => array(
                            'items-start' => 'linksbündig',
                            'items-center' => 'zentriert',
                            'items-end' => 'rechtsbündig',
                        ),
                        'wrapper' => array(
                            'width' => '50',
                        ),
                        'allow_null' => 0,
                        'default_value' => 'items-start',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_61a9dd5cdb04b',
                        'label' => 'Bild',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'return_format' => 'id',
                        'preview_size' => 'medium',
                        'library' => 'all',
                    ),
                    array(
                        'key' => 'field_5f9a99b2eee59',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                    ),
                    array(
                        'key' => 'field_5f9a99c2eee5a',
                        'label' => 'Text',
                        'name' => 'body',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'new_lines' => 'wpautop',
                    ),
                    array(
                        'key' => 'field_5f9a99cbeee5b',
                        'label' => 'Buttons',
                        'name' => 'buttons',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'collapsed' => 'field_5f9a99dbeee5c',
                        'min' => 0,
                        'max' => 2,
                        'layout' => '',
                        'button_label' => 'Button hinzufügen',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_5f9a99dbeee5c',
                                'label' => 'Link',
                                'name' => 'link',
                                'type' => 'link',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '50%',
                                    'class' => '',
                                    'id' => '',
                                ),
                            ),
                            array(
                                'key' => 'field_61a9dbafc71e2',
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
                                    'secondary' => 'Sekundär',
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
