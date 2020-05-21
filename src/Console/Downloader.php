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
use Symfony\Component\Console\Output\OutputInterface;

trait Downloader
{
    /**
     * Download an archive from url to a destination.
     *
     * @param string $url
     * @param string $destination
     */
    protected static function download($url, $destination, OutputInterface $output = null)
    {
        if (! is_dir($dir = dirname($destination))) {
            mkdir($dir, 0777, true);
        }

        if (is_dir($destination)) {
            static::rmdir($destination);
        }

        if (file_exists($destination)) {
            unlink($destination);
        }

        $progress = $output ? new Progress(function ($str) use ($output) {
            $output->write($str);
        }) : new Progress;

        $zip = (new ZipDownloader($url))->callback($progress);

        $zip->download($destination);
    }

    /**
     * Remove a directory.
     *
     * @param string $path
     */
    protected static function rmdir($path)
    {
        $files = array_diff(scandir($path), ['.', '..']);

        foreach ($files as $file) {
            is_dir($p = "{$path}/{$file}") ? static::rmdir($p) : unlink($p);
        }

        return rmdir($path);
    }
}
