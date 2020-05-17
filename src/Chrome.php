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

use Facebook\WebDriver\Chrome\ChromeOptions;
use Bhittani\WebDriver\Process\Chrome as Process;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class Chrome extends Driver
{
    use Maker;

    /** {@inheritdoc} */
    public function supportsRemoteLogs()
    {
        return true;
    }

    /** {@inheritdoc} */
    protected static function makeProcess($binary)
    {
        return new Process($binary);
    }

    /** {@inheritdoc} */
    protected static function getBrowserCapabilities($payload)
    {
        $options = (new ChromeOptions)->addArguments(array_filter([
            $payload->isHeadless() ? '--headless' : null,
            $payload->useGpu() ? null : '--disable-gpu',
            "--window-size={$payload->getWidth()},{$payload->getHeight()}",
        ]));

        return DesiredCapabilities::chrome()->setCapability(
            ChromeOptions::CAPABILITY_W3C,
            $options
        );
    }
}
