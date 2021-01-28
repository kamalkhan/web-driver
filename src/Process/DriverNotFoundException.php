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

use RuntimeException;

class DriverNotFoundException extends RuntimeException
{
    public static function make($name)
    {
        return new static("The binary for the '{$name}' driver was not found. Try running 'vendor/bin/install-{$name}-driver'.");
    }
}
