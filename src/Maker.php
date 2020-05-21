<?php

/*
 * This file is part of bhittani/web-driver.
 *
 * (c) Kamal Khan <shout@bhittani.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Bhittani\WebDriver;

use Exception;
use RuntimeException;
use Bhittani\WebDriver\Payload\Payload;
use Bhittani\WebDriver\Payload\Contract as PayloadContract;
use Bhittani\WebDriver\Process\Contract as ProcessContract;

trait Maker
{
    /**
     * Driver process.
     *
     * @var ProcessContract
     */
    public static $process;

    /**
     * Make the remote web driver.
     *
     * @param string|ProcessContract $processOrBinary
     * @param array|PayloadContract  $payload
     *
     * @return Contract
     */
    public static function make($processOrBinary = null, $payload = [])
    {
        if ($processOrBinary instanceof ProcessContract) {
            if (static::$process) {
                static::$process->stop();
            }

            static::$process = $processOrBinary;
        }

        if (! static::$process) {
            static::$process = static::makeProcess($processOrBinary);
        }

        if (! static::$process->isRunning()) {
            static::$process->start();
        }

        $payload = $payload instanceof PayloadContract
            ? $payload : Payload::make($payload);

        return static::retryCallback(function () use ($payload) {
            return static::create(
                static::$process->getUrl(),
                static::getBrowserCapabilities($payload)
            );
        });
    }

    /**
     * Retry a callback.
     *
     * @param int $timeout
     * @param int $interval
     *
     * @throws RuntimeException if the callback can not be resolved before the timeout
     *
     * @return mixed
     */
    protected static function retryCallback(callable $callback, $timeout = 3000, $interval = 50)
    {
        $stop = microtime(true) + $timeout / 1000;

        while (true) {
            try {
                return $callback();
            } catch (Exception $e) {
                if (microtime(true) > $stop) {
                    throw new RuntimeException(sprintf('Timed out while attempting to connect to the %s server after %d ms.', basename(str_replace('\\', '/', static::class)), $timeout), $e->getCode(), $e);
                }

                usleep($interval * 1000);
            }
        }
    }

    /**
     * Make a process.
     *
     * @param mixed $binary
     *
     * @throws RuntimeException if the process can not be created
     *
     * @return ProcessContract
     */
    protected static function makeProcess($binary)
    {
        throw new RuntimeException(sprintf('Could not create a process for the %s driver.', basename(str_replace('\\', '/', static::class))));
    }

    /**
     * Get the browser capabilities.
     *
     * @param PayloadContract $payload
     *
     * @return array|\Facebook\WebDriver\WebDriverCapabilities
     */
    protected static function getBrowserCapabilities($payload)
    {
        return [];
    }
}
