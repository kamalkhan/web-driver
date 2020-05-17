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

class Phantomjs extends Process
{
    /** {@inheritdoc} */
    protected function getCommand()
    {
        return [
            $this->binary,
            '--webdriver=localhost:'.$this->port,
        ];
    }
}
