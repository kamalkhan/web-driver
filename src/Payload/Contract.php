<?php

/*
 * This file is part of bhittani/web-driver.
 *
 * (c) Kamal Khan <shout@bhittani.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Bhittani\WebDriver\Payload;

interface Contract
{
    /**
     * Check whether to use the browser GPU or not.
     *
     * @return bool
     */
    public function useGpu();

    /**
     * Check whether to use a headless browser or not.
     *
     * @return bool
     */
    public function isHeadless();

    /**
     * Get the browser width.
     *
     * @return int
     */
    public function getWidth();

    /**
     * Get the browser height.
     *
     * @return int
     */
    public function getHeight();
}
