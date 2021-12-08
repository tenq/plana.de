<?php

namespace Brainson\Scaffold;

abstract class ContentComponentAbstract implements ContentComponentInterface
{
    public static $isNestable = false;

    public static $hasNestedLevel = false;

    public static $mainLevel = true;

    public $isNested = false;

    public $parentObject = null;

    public $slotName = "";

    public $data;

    public function prepareData($data): void
    {
        unset($data['acf_fc_layout']);
        $this->data = $data;
    }

    public function renderOutput(): string
    {
        return \Timber::compile(static::getComponentTemplatePath(), ['object' => $this]);
    }

    public function getRenderSize(): ?string
    {
        return null;
    }
}
