<?php

/*
 * This file is part of bhittani/web-driver.
 *
 * (c) Kamal Khan <shout@bhittani.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Bhittani\WebDriver\Process;

interface Contract
{
    /** Start the driver. */
    public function start();

    /** Stop the driver. */
    public function stop();

    /**
     * Check if the driver is running or not.
     *
     * @return bool
     */
    public function isRunning();

    /**
     * Get the driver URL.
     *
     * @return string
     */
    public function getUrl();
}
