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

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\JavaScriptExecutor;
use Facebook\WebDriver\WebDriverHasInputDevices;

interface Contract extends WebDriver, JavaScriptExecutor, WebDriverHasInputDevices
{
    /**
     * Check whether the driver supports remote logs or not.
     *
     * @return bool
     */
    public function supportsRemoteLogs();
}
