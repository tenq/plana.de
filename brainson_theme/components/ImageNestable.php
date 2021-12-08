<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class ImageNestable extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = true;

    public static $mainLevel = false;

    public static function getComponentName(): string
    {
        return 'imagenestable';
    }

    public static function getComponentLabel(): string
    {
        return 'Bild';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/image-nestable.twig';
    }

    public function defineFields(): array
    {
        return [

            'key' => 'content_component_iamge_nestable',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields(['margin_top']),
                [
                    array(
                        'key' => 'field_5f9a88fc50417',
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
                        'preview_size' => 'c9-desktop',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                ],
                $this->defineGlobalFields(['uniqueid'])
            )
        ];
    }
}
