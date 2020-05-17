<?php

namespace Bhittani\WebDriver\Process;

class ChromeTest extends TestCase
{
    function makeProcess()
    {
        return new Chrome(__DIR__.'/../fixtures/chrome-fake');
    }

    /** @test */
    function it_implements_the_contract()
    {
        $this->assertInstanceOf(Contract::class, $this->process);
    }

    /** @test */
    function it_can_tell_whether_the_driver_is_running_or_not()
    {
        $this->assertFalse($this->process->isRunning());

        $this->process->start();

        $this->assertTrue($this->process->isRunning());

        $this->process->stop();

        $this->assertFalse($this->process->isRunning());
    }

    /** @test */
    function it_provides_the_url_to_the_driver()
    {
        $url = $this->process->getUrl();

        $this->assertEquals('http://localhost:9515', $url);
    }
}
