<?php

namespace GibbonCms\Pages;

use GibbonCms\Gibbon\Factories\Factory;
use GibbonCms\Gibbon\Support\FactoryHelpers;

class PageFactory implements Factory
{
    use FactoryHelpers;

    /**
     * Transform raw data to an entity
     * 
     * @param array $data
     * @return \GibbonCms\Blog\Post
     */
    public function make($data)
    {
        $parts = $this->splitData($data['data'], ['meta', 'body']);

        $meta = self::parseYaml($parts['meta']);

        return $this->createAndFill([
            'id'                => $data['id'],
            'title'             => $meta['title'],
            'body'              => $parts['body'],
        ]);
    }

    /**
     * Transform a page to raw data
     * 
     * @param \GibbonCms\Pages\Page $page
     * @return string
     */
    public function encode($page)
    {
        $contents = ''
            . $this->dumpToSimpleYaml([
                'title' => $page->title,
            ])
            . $this->getDataSeparator()
            . $page->body
        ;

        return $contents;
    }

    /**
     * Return the classname of the entity this factory makes
     * 
     * @return string
     */
    public static function makes()
    {
        return Page::class;
    }
}
