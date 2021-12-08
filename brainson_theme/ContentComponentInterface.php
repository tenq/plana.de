<?php

namespace Brainson\Scaffold;

interface ContentComponentInterface
{
    public function defineFields(): array;

    public function prepareData($data): void;

    public function renderOutput(): string;

    public static function getComponentName(): string;

    public static function getComponentLabel(): string;

    public function getRenderSize(): ?string;
}
