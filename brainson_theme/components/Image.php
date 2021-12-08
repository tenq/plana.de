<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class Image extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = false;

    public static function getComponentName(): string
    {
        return 'image';
    }

    public static function getComponentLabel(): string
    {
        return 'Bild';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/image.twig';
    }

    public function defineFields(): array
    {
        return [

            'key' => 'content_component_image',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                [
                    array(
                        'key' => 'field_5ece4797eaf5e',
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
                $this->defineGlobalFields(['margin_top', 'alternate_background', 'padding_top', 'padding_bottom', 'container_width', 'uniqueid']),
                array(
                    array(
                        'key' => 'field_5f9a88c850415',
                        'label' => 'Text anzeigen',
                        'name' => 'show_text',
                        'type' => 'true_false',
                        'instructions' => 'Soll ein Text auf dem Bild angezeigt werden?',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_5f9a888b50413',
                        'label' => 'Bild',
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
                        'key' => 'field_5f9a88fc50416',
                        'label' => 'Bild',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'id',
                        'preview_size' => 'c1-tablet',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                    array(
                        'key' => 'field_5f9a892950417',
                        'label' => 'Darstellung',
                        'name' => 'style',
                        'type' => 'button_group',
                        'instructions' => 'Legt die Darstellungsbreite des Bildes fest',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'hero' => $this->getIconSVG('admin-hero-width') . 'Hero',
                            'content_width' => $this->getIconSVG('admin-content-width') . 'Containerbreite',
                        ),
                        'allow_null' => 0,
                        'default_value' => '',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5f9a88b650414',
                        'label' => 'Text',
                        'name' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5f9a88c850415',
                                    'operator' => '==',
                                    'value' => '1',
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
                        'key' => 'field_5f9a8a4b5041c',
                        'label' => 'Textposition',
                        'name' => 'text_position',
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
                            'left' => $this->getIconSVG('admin-textalign-left') . 'Links',
                            'right' => $this->getIconSVG('admin-textalign-right') . 'Rechts',
                        ),
                        'allow_null' => 0,
                        'default_value' => '',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5f9a8a1a5041b',
                        'label' => 'Textfarbe',
                        'name' => 'text_color',
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
                            'light' => 'Hell',
                            'dark' => 'Dunkel',
                        ),
                        'allow_null' => 0,
                        'default_value' => '',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5f9a89b450418',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f9a89cd50419',
                        'label' => 'Text',
                        'name' => 'body',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'maxlength' => '',
                        'rows' => '',
                        'new_lines' => '',
                    ),
                    array(
                        'key' => 'field_5f9a8a055041a',
                        'label' => 'CTA Button',
                        'name' => 'cta_button',
                        'type' => 'link',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'array',
                    ),
                )
            )
        ];
    }

    public function getTextColorClassString(): string
    {
        switch ($this->data['text_color']) {
            case 'light':
                return 'text-white';
                break;
            default:
                return 'text-grey-700';
                break;
        }
    }

    public function getTextPositionClassString(): string
    {
        switch ($this->data['text_position']) {
            case 'left':
                return 'alignment-class-left';
                break;
            default:
                return 'alignment-class-right';
                break;
        }
    }
}
