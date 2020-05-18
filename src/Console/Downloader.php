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

use Bhittani\Download\Zip as ZipDownloader;
use Bhittani\Download\Progress\Standard as Progress;

trait Downloader
{
    /**
     * Download an archive from url to a destination.
     *
     * @param string $url
     * @param string $destination
     */
    protected function download($url, $destination)
    {
        if (! is_dir($dir = dirname($destination))) {
            mkdir($dir, 0777, true);
        }

        if (is_dir($destination)) {
            $this->rmdir($destination);
        }

        if (file_exists($destination)) {
            unlink($destination);
        }

        $zip = (new ZipDownloader($url))
            ->callback(new Progress(function ($progress) {
                $this->output->write($progress);
            }));

        $zip->download($destination);
    }

    /**
     * Remove a directory.
     *
     * @param string $path
     */
    protected function rmdir($path)
    {
        $files = array_diff(scandir($path), ['.', '..']);

        foreach ($files as $file) {
            is_dir($p = "{$path}/{$file}") ? $this->rmdir($p) : unlink($p);
        }

        return rmdir($path);
    }
}
