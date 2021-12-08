<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class Testimonial extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = true;

    public static function getComponentName(): string
    {
        return 'testimonial';
    }

    public static function getComponentLabel(): string
    {
        return 'Testimonial';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/testimonial.twig';
    }

    public function defineFields(): array
    {

        $globalFields = $this->isNested ? ['margin_top'] : ['margin_top', 'alternate_background', 'padding_top', 'padding_bottom', 'container_width'];

        return array(

            'key' => 'content_component_testimonial',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields(['margin_top', 'alternate_background', 'padding_top', 'padding_bottom', 'container_width']),
                [
                    array(
                        'key' => 'field_619e1260df777',
                        'label' => 'Slider-Carousel',
                        'name' => 'carousel',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => 'Soll das Testimonial mit weiteren Testimonials in einem Slider-Carousel dargestellt werden?',
                        'default_value' => 0,
                    ),
                    array(
                        'key' => 'field_619e14043db4a',
                        'label' => 'Bild',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'ID',
                        'preview_size' => 'square_small',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_619e1260df777',
                                    'operator' => '==',
                                    'value' => '0',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_619e14043db9a',
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_619e1260df777',
                                    'operator' => '==',
                                    'value' => '0',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_619e14043dc22',
                        'label' => 'Position',
                        'name' => 'position',
                        'type' => 'text',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_619e1260df777',
                                    'operator' => '==',
                                    'value' => '0',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_619e14043dbdf',
                        'label' => 'Zitat',
                        'name' => 'cite',
                        'type' => 'textarea',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_619e1260df777',
                                    'operator' => '==',
                                    'value' => '0',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_619e11e43e090',
                        'label' => 'Testimonials',
                        'name' => 'items',
                        'type' => 'repeater',
                        'layout' => 'table',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_619e1260df777',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'sub_fields' => array(
                            array(
                                'key' => 'field_619e1260df647',
                                'label' => 'Bild',
                                'name' => 'image',
                                'type' => 'image',
                                'return_format' => 'ID',
                                'preview_size' => 'square_small',
                            ),
                            array(
                                'key' => 'field_619e1260df689',
                                'label' => 'Name',
                                'name' => 'name',
                                'type' => 'text',
                                'required' => 1,
                            ),
                            array(
                                'key' => 'field_619e14043dc65',
                                'label' => 'Position',
                                'name' => 'position',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_619e1260df6c5',
                                'label' => 'Zitat',
                                'name' => 'cite',
                                'type' => 'textarea',
                                'required' => 1,
                            ),
                        ),
                    ),
                ],
                $this->defineGlobalFields(['uniqueid'])
            )
        );
    }
}
