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

abstract class InstallDriverCommand extends Command
{
    use CurrentOS;
    use Downloader;

    /** @var string Destination for the drivers. */
    protected $destination = __DIR__.'/../../drivers';

    /**
     * Get the destination path.
     *
     * @return string
     */
    protected function getDestination()
    {
        return rtrim($this->destination, '\/').'/'.$this->getDriverName();
    }

    /**
     * Get the compiled destination path.
     *
     * @return string
     */
    protected function getCompiledDestination()
    {
        return $this->getDestination().static::getOSExtension();
    }

    /**
     * Get the desired driver version.
     *
     * @return string
     */
    protected function getVersion()
    {
        $version = $this->input->getArgument('version');

        if (! $version || $version == 'latest') {
            return $this->getLatestVersion();
        }

        return $version;
    }

    /**
     * Get the latest driver version.
     *
     * @return string
     */
    abstract protected function getLatestVersion();

    /**
     * Get the destination driver name.
     *
     * @return string
     */
    abstract protected function getDriverName();
}
