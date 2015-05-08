<?php namespace GibbonCms\Pages\Tests;

use GibbonCms\Pages\Page;
use GibbonCms\Pages\PageFactory;

class PageFactoryTest extends TestCase
{
    function setUp()
    {
        $this->factory = new PageFactory;
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(PageFactory::class, $this->factory);
    }

    /** @test */
    function it_makes_an_entity()
    {
        $page = $this->factory->make([
            'id' => 'dummy',
            'data' => file_get_contents($this->fixtures . '/pages/dummy.md'),
        ]);

        $this->assertInstanceOf(Page::class, $page);
        $this->assertEquals('dummy', $page->getIdentifier());
        $this->assertEquals('Dummy', $page->title);
        $this->assertRegexp('/## Hello world/', $page->body);
        $this->assertRegexp('/<h2>Hello world<\/h2>/', $page->getRenderedBody());
    }

    /** @test */
    function it_encodes_an_entity()
    {
        $page = $this->factory->make([
            'id' => 'dummy',
            'data' => file_get_contents($this->fixtures . '/pages/dummy.md'),
        ]);

        $raw = $this->factory->encode($page);

        $this->assertEquals(file_get_contents($this->fixtures . '/pages/dummy.md'), $raw);
    }
}
