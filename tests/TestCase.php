<?php

namespace Bhittani\WebDriver;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    var $driver;

    abstract function makeDriver();

    function setUp()
    {
        $this->driver = $this->makeDriver();
    }

    function tearDown()
    {
        $this->driver->quit();
    }
}
