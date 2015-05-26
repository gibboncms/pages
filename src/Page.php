<?php

namespace GibbonCms\Pages;

use GibbonCms\Gibbon\Entities\Entity;

class Page extends Entity
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $body;

    /**
     * @return string
     */
    public function render()
    {
        return PageFactory::parseMarkdown($this->body);
    }
}
