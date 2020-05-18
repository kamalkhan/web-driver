<?php

/*
 * This file is part of bhittani/web-driver.
 *
 * (c) Kamal Khan <shout@bhittani.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Bhittani\WebDriver\Console;

trait CurrentOS
{
    /**
     * Detect the current operating system.
     *
     * @return string
     */
    protected function getCurrentOS()
    {
        if (
            PHP_OS === 'WINNT'
            || (strpos(php_uname(), 'Microsoft') !== false)
        ) {
            return 'win';
        }

        return PHP_OS === 'Darwin' ? 'mac' : 'linux';
    }
}
