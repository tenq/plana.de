<?php

namespace Brainson\Scaffold;

class LanguageSwitcher
{
    public $languages = [];

    private $skip_missing;

    public $active;

    public function __construct($skip_missing = true)
    {
        $this->skip_missing = $skip_missing;  // set show missing. If false: also not translated languages get showed
        $this->active = $this->isWPMLActive();

        $this->languages = $this->getLanguageArray();
    }

    public function getLanguageArray(): array
    {
        if (!$this->isWPMLActive()) return [];

        return \icl_get_languages('skip_missing=' . (int)$this->skip_missing . '&orderby=custom&order=asc');
    }

    public function isWPMLActive(): bool
    {
        return function_exists('icl_object_id');
    }
}
