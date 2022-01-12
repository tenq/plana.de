<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class VideoCTA extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = true;


    public static function getComponentName(): string
    {
        return 'videocta';
    }

    public static function getComponentLabel(): string
    {
        return 'Video CTA';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/video-cta.twig';
    }

    public function defineFields(): array
    {
        $globalFields = $this->isNested ? ['margin_top'] : ['margin_top', 'container_width'];

        return [

            'key' => 'content_component_videocta',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields($globalFields),
                [
                    array(
                        'key' => 'field_ppm4nmeyucb0l',
                        'label' => 'Topline',
                        'name' => 'topline',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                    ),
                    array(
                        'key' => 'field_78yjpy7bdejb7',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                    ),
                    array(
                        'key' => 'field_6uq2o3t4zqawf',
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
