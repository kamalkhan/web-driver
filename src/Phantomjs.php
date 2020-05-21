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

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Bhittani\WebDriver\Process\Phantomjs as Process;

class Phantomjs extends Driver
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
        return $binary ? new Process($binary) : Process::make();
    }

    /** {@inheritdoc} */
    protected static function getBrowserCapabilities($payload)
    {
        return DesiredCapabilities::phantomjs();
    }
}
