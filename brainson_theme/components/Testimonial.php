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
                        'key' => 'field_619e140433456',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'textarea',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_619e14043db9a',
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_619e14043dc22',
                        'label' => 'Position',
                        'name' => 'position',
                        'type' => 'text',
                    ),
                ],
                $this->defineGlobalFields(['uniqueid'])
            )
        );
    }
}
