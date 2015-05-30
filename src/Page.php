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
     * @var array
     */
    public $data;

    /**
     * @var string
     */
    public $body;
}
