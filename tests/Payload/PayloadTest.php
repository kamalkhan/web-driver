<?php

namespace Bhittani\WebDriver\Payload;

use PHPUnit\Framework\TestCase;

class PayloadTest extends TestCase
{
    /** @test */
    function it_implements_the_contract()
    {
        $this->assertInstanceOf(Contract::class, new Payload);
    }

    /** @test */
    function it_can_toggle_the_gpu_option()
    {
        $payload = new Payload;

        $this->assertTrue($payload->useGpu());

        $payload->gpu(false);

        $this->assertFalse($payload->useGpu());
    }

    /** @test */
    function it_can_toggle_the_headless_option()
    {
        $payload = new Payload;

        $this->assertTrue($payload->isHeadless());

        $payload->headless(false);

        $this->assertFalse($payload->isHeadless());
    }

    /** @test */
    function it_can_set_the_width_option()
    {
        $payload = new Payload;

        $this->assertEquals(1440, $payload->getWidth());

        $payload->width(1280);

        $this->assertEquals(1280, $payload->getWidth());
    }

    /** @test */
    function it_can_set_the_height_option()
    {
        $payload = new Payload;

        $this->assertEquals(900, $payload->getHeight());

        $payload->height(720);

        $this->assertEquals(720, $payload->getHeight());
    }

    /** @test */
    function it_can_be_made_using_an_array_of_options()
    {
        $payload = Payload::make([
            'foo' => 'bar',
            'gpu' => false,
            'width' => 1280,
            'height' => 720,
            'headless' => false,
        ]);

        $this->assertFalse($payload->useGpu());
        $this->assertFalse($payload->isHeadless());
        $this->assertEquals(1280, $payload->getWidth());
        $this->assertEquals(720, $payload->getHeight());
    }
}
