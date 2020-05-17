<?php

namespace Bhittani\WebDriver;

class PhantomjsTest extends TestCase
{
    function makeDriver()
    {
        return Phantomjs::make(__DIR__.'/fixtures/phantomjs');
    }

    /** @test */
    function it_implements_the_contract()
    {
        $this->assertInstanceOf(Contract::class, $this->driver);
    }

    /** @test */
    function it_makes_use_of_the_facebook_web_driver()
    {
        $this->assertEquals('Google', $this->driver->get('https://google.com')->getTitle());
    }
}
