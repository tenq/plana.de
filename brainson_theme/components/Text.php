<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class Text extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static function getComponentName(): string
    {
        return 'text';
    }

    public static function getComponentLabel(): string
    {
        return 'Text';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/text.twig';
    }

    public function defineFields(): array
    {
        return [

            'key' => 'content_component_text',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields(['margin_top', 'alternate_background', 'padding_top', 'padding_bottom', 'container_width']),
                [
                    array(
                        'key' => 'field_5f9a9652aed11',
                        'label' => 'Spalten (automatische Trennung)',
                        'name' => 'columns',
                        'type' => 'button_group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            1 => $this->getIconSVG('admin-columns-1') . '1',
                            2 => $this->getIconSVG('admin-columns-2') . '2',
                            3 => $this->getIconSVG('admin-columns-3') . '3',
                        ),
                        'allow_null' => 0,
                        'default_value' => '',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_5f9a9686aed12',
                        'label' => 'Text',
                        'name' => 'content',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'basic',
                        'media_upload' => 1,
                        'delay' => 0,
                    ),
                ],
                $this->defineGlobalFields(['uniqueid'])
            )
        ];
    }
}
