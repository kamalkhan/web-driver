<?php

namespace Bhittani\WebDriver;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    static $driverClass;

    var $driver;

    /** @afterClass */
    static function stopProcess()
    {
        $class = static::$driverClass;

        if ($process = $class::$process) {
            $process->stop();
        }
    }

    function setUp()
    {
        $this->driver = $this->makeDriver();
    }

    function tearDown()
    {
        $this->driver->quit();
    }

    function makeDriver()
    {
        $class = static::$driverClass;

        return $class::make();
    }
}
