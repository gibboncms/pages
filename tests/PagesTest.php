<?php namespace GibbonCms\Pages\Tests;

use GibbonCms\Pages\Pages;
use GibbonCms\Pages\Page;

class PagesTest extends TestCase
{
    function setUp()
    {
        $this->pages = new Pages($this->fixtures . '/pages');
        $this->pages->build();
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

    /** @tes */
    function it_gets_all_pages()
    {
        $this->assertCount(1, $this->pages->getAll());
    }
}
