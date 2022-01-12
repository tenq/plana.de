<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class Map extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = true;


    public static function getComponentName(): string
    {
        return 'map';
    }

    public static function getComponentLabel(): string
    {
        return 'Karte';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/map.twig';
    }

    public function defineFields(): array
    {
        $globalFields = $this->isNested ? ['margin_top'] : ['margin_top', 'container_width'];

        return [

            'key' => 'content_component_map',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields($globalFields),
                [
                    array(
                        'key' => 'field_og06uxksuv71y',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                    ),
                    array(
                        'key' => 'field_y6jbtsysnp5rk',
                        'label' => 'Text',
                        'name' => 'body',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'new_lines' => 'wpautop',
                    ),
                    array(
                        'key' => 'field_u7zrry1qxkp0n',
                        'label' => 'Link',
                        'name' => 'link',
                        'type' => 'link',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '50%',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'array',
                    ),
                ],
                $this->defineGlobalFields(['uniqueid'])
            )
        ];
    }
}
