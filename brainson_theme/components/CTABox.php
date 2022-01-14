<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class CTABox extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = false;


    public static function getComponentName(): string
    {
        return 'ctabox';
    }

    public static function getComponentLabel(): string
    {
        return 'CTA Box + herunterladen';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/cta-box.twig';
    }

    public function defineFields(): array
    {
        $globalFields = $this->isNested ? ['margin_top'] : ['margin_top', 'container_width'];

        return [

            'key' => 'content_component_ctabox',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields($globalFields),
                [
                    array(
                        'key' => 'field_5f9a99b2eee59',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                    ),
                    array(
                        'key' => 'field_5f9a99c2eee5a',
                        'label' => 'Text',
                        'name' => 'body',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'new_lines' => 'wpautop',
                    ),
                    array(
                        'key' => 'field_5f9a99c2e4567',
                        'label' => 'Schaltflächentitel',
                        'name' => 'btn',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                    ),
                    array(
                        'key' => 'field_5f9a99c2e5678',
                        'label' => 'Datei',
                        'name' => 'file',
                        'type' => 'file',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                    ),
                ],
                $this->defineGlobalFields(['uniqueid'])
            )
        ];
    }
}
