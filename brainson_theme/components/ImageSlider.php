<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class ImageSlider extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $hasNestedLevel = false;

    public static function getComponentName(): string
    {
        return 'imageslider';
    }

    public static function getComponentLabel(): string
    {
        return 'Slider';
    }


    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/image-slider.twig';
    }

    public function defineFields(): array
    {

        return [

            'key' => 'content_component_imageslider',
            'name' => $this->getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields(['margin_top']),
                [

                    array(
                        'key' => 'field_608bf53f9dbbd',
                        'label' => 'Slides',
                        'name' => 'slides',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'collapsed' => '',
                        'min' => 1,
                        'max' => 7,
                        'layout' => 'row',
                        'button_label' => '',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_608bf55a9dbbe',
                                'label' => 'Bild',
                                'name' => 'image',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 1,
                                'return_format' => 'id',
                                'preview_size' => 'medium',
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
                                'key' => 'field_608bf56e9dbbf',
                                'label' => 'Titel',
                                'name' => 'title',
                                'type' => 'text',
                                'instructions' => 'Max. 30 Zeichen',
                                'required' => 0,
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '30',
                            ),
                            array(
                                'key' => 'field_608bf57f9dbc0',
                                'label' => 'Subline',
                                'name' => 'subline',
                                'type' => 'text',
                                'instructions' => 'Max. 130 Zeichen',
                                'required' => 0,
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '130',
                            ),
                        ),
                    ),
                ]
            )
        ];
    }

    public function getAlignmentClass()
    {
        return $this->data['alignment'] == 'image_left' ? 'left' : 'right';
    }

    public function get_container_class_string(): string
    {
        return '';
    }
}
