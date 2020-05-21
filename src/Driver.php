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

use Facebook\WebDriver\Remote\RemoteWebDriver;

abstract class Driver extends RemoteWebDriver implements Contract
{
    /** {@inheritdoc} */
    public function supportsRemoteLogs()
    {
        return false;
    }
}
