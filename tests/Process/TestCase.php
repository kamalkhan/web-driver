<?php

namespace Bhittani\WebDriver\Process;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    var $process;

    abstract function makeProcess();

    function setUp()
    {
        $this->process = $this->makeProcess();
    }

    function tearDown()
    {
        $this->process->stop();
    }
}
