<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class Divider extends ContentComponentAbstract
{

    use GlobalFieldsTrait;

    public static $isNestable = true;


    public static function getComponentName(): string
    {
        return 'divider';
    }

    public static function getComponentLabel(): string
    {
        return 'Trenner';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/divider.twig';
    }

    public function defineFields(): array
    {

        return [

            'key' => 'content_component_divider',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields(['margin_top', 'alternate_background', 'padding_top', 'padding_bottom']),
                [
                    array(
                        'key' => 'field_5f89a63c3b255',
                        'label' => '',
                        'name' => 'divider',
                        'type' => 'message',
                        'message' => 'Der Trenner fügt eine Trennlinie auf der Seite ein.',
                    ),
                ],
                $this->defineGlobalFields(['uniqueid'])
            )
        ];
    }
}
