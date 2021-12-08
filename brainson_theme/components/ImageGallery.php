<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class ImageGallery extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $hasNestedLevel = false;

    public static function getComponentName(): string
    {
        return 'imagegallery';
    }

    public static function getComponentLabel(): string
    {
        return 'Galerie';
    }


    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/image-gallery.twig';
    }

    public function defineFields(): array
    {

        return [

            'key' => 'content_component_imagegallery',
            'name' => $this->getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields(['margin_top', 'padding_top', 'padding_bottom', 'container_width']),
                [

                    array(
                        'key' => 'field_60882278251b9',
                        'label' => 'Bilder',
                        'name' => 'images',
                        'type' => 'gallery',
                        'instructions' => '',
                        'required' => 1,
                        'return_format' => 'id',
                        'preview_size' => 'medium',
                        'insert' => 'append',
                        'library' => 'all',
                    ),


                ]
            )
        ];
    }

    public function getAlignmentClass()
    {
        return $this->data['alignment'] == 'image_left' ? 'left' : 'right';
    }
}
