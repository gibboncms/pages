<?php

namespace GibbonCms\Pages\Test;

use GibbonCms\Pages\Pages;
use GibbonCms\Pages\Page;
use GibbonCms\Gibbon\Filesystems\PlainFilesystem;
use GibbonCms\Gibbon\Filesystems\FileCache;

class PagesTest extends TestCase
{
    function setUp()
    {
        $this->pages = new Pages(
            new PlainFilesystem($this->fixtures),
            'pages',
            new FileCache($this->fixtures.'/pages/.cache')
        );

        $this->pages->setUp();
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(Pages::class, $this->pages);
    }

    /** @test */
    function it_gets_a_page()
    {
        $this->assertInstanceOf(Page::class, $this->pages->find('dummy'));
    }

    /** @test */
    function it_gets_a_subpage()
    {
        $this->assertInstanceOf(Page::class, $this->pages->find('subpages/subpage'));
    }

    /** @test */
    function it_gets_all_pages()
    {
        $this->assertCount(2, $this->pages->getAll());
        $this->assertContainsOnlyInstancesOf(Page::class, $this->pages->getAll());
    }
}
