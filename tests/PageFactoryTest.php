<?php

namespace GibbonCms\Pages\Test;

use GibbonCms\Gibbon\Exceptions\EntityParseException;
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
        $this->assertEquals('Hello world from gibbon', $page->data['meta_description']);
        $this->assertRegexp('/## Hello world/', $page->body);
    }

    /** @test */
    function it_fails_on_an_invalid_entity()
    {
        $this->setExpectedException(EntityParseException::class);

        $page = $this->factory->make([
            'id' => 'invalid',
            'data' => file_get_contents($this->fixtures . '/pages/invalid.md'),
        ]);
    }
}
