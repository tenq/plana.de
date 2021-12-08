<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class TextNestable extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = true;

    public static $mainLevel = false;

    public static function getComponentName(): string
    {
        return 'textnestable';
    }

    public static function getComponentLabel(): string
    {
        return 'Text';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/text-nestable.twig';
    }

    public function defineFields(): array
    {
        return [

            'key' => 'content_component_text_nestable',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields(['margin_top']),
                [
                    array(
                        'key' => 'field_5f9a9686aed13',
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

    /*
    *
    * getrenderSize() example implementation
    *
    */

    // public function getRenderSize(): ?string
    // {
    //     if (isset($this->parentObject)) {
    //         if ($this->parentObject->getComponentName() == 'twocolumns') {
    //             $weighting = $this->parentObject->data['weighting'];
    //             if ($this->slotName == 'twocolumns_2') {
    //                 if ($weighting == 'two-three') {
    //                     return '60';
    //                 } elseif ($weighting == 'two-one') {
    //                     return '33';
    //                 }
    //             } elseif ($this->slotName == 'twocolumns_1') {
    //                 if ($weighting == 'two-three') {
    //                     return '40';
    //                 } elseif ($weighting == 'two-one') {
    //                     return '66';
    //                 }
    //             }
    //         }
    //     }
    //     return null;
    // }
}
