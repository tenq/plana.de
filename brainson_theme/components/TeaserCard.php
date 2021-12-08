<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class TeaserCard extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = true;

    public static $mainLevel = false;

    public static function getComponentName(): string
    {
        return 'teaserCard';
    }

    public static function getComponentLabel(): string
    {
        return 'Teaser Card';
    }

    protected  function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/teaser-card.twig';
    }

    public function defineFields(): array
    {
        return [
            'key' => 'content_component_teaser_card',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields(['margin_top']),
                [
                    [
                        'key' => 'field_61813b3cdba7e',
                        'label' => 'Bild',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => 'Seitenverhältnis 3:2',
                        'required' => 1,
                        'conditional_logic' => 0,
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
                    ],
                    [
                        'key' => 'field_61813b6bdba7f',
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
                        'key' => 'field_61813ca0dba81',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 0,
                        'delay' => 0,
                    ],
                    [
                        'key' => 'field_61813cdcdba82',
                        'label' => 'Button',
                        'name' => 'button',
                        'type' => 'link',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'return_format' => 'array',
                    ],
                ]
            )
        ];
    }
}