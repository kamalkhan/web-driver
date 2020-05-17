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

use Bhittani\WebDriver\Payload\Payload;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Bhittani\WebDriver\Payload\Contract as PayloadContract;
use Bhittani\WebDriver\Process\Contract as ProcessContract;

abstract class Driver extends RemoteWebDriver implements Contract
{
    // /**
    //  * Make the remote web driver.
    //  *
    //  * @param string|ProcessContract $processOrUrl
    //  * @param array|PayloadContract $payload
    //  *
    //  * @return Driver
    //  */
    // public static function make0($processOrUrl, $payload = [])
    // {
    //     $url = $processOrUrl instanceof ProcessContract
    //         ? $processOrUrl->getUrl()
    //         : $processOrUrl;

    //     $payload = $payload instanceof PayloadContract
    //         ? $payload
    //         : Payload::make($payload);

    //     return static::create($url, static::getBrowserCapabilities($payload));
    // }

    // /**
    //  * Get the browser capabilities.
    //  *
    //  * @param PayloadContract $payload
    //  *
    //  * @return array|\Facebook\WebDriver\WebDriverCapabilities
    //  */
    // protected static function getBrowserCapabilities($payload)
    // {
    //     return [];
    // }

    /** {@inheritdoc} */
    public function supportsRemoteLogs()
    {
        return false;
    }
}
