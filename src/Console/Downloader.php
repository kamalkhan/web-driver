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

use PharData;
use DirectoryIterator;
use Bhittani\Download\Zip as ZipDownloader;
use Bhittani\Download\File as FileDownloader;
use Bhittani\Download\Progress\Standard as Progress;
use Symfony\Component\Console\Output\OutputInterface;

trait Downloader
{
    /**
     * Download an archive from url to a destination.
     *
     * @param string $url
     * @param string $destination
     * @param string
     */
    protected static function download($url, $destination, OutputInterface $output = null)
    {
        if (preg_match('/\.tar\.bz2?$/', $url)) {
            return static::downloadTarBz2($url, $destination, $output);
        }

        static::ensureEmptyDir($destination);

        (new ZipDownloader($url))
            ->callback(static::makeProgressBar($output))
            ->download($destination);

        return $destination;
    }

    /**
     * Download a tar.bz2 file from url to a destination.
     *
     * @todo Move to bhittani/download
     *
     * @param string $url
     * @param string $destination
     *
     * @return string
     */
    protected static function downloadTarBz2($url, $destination, OutputInterface $output = null)
    {
        static::ensureEmptyDir($destination);

        $tar = $destination.'.tar';
        $tarBz2 = $destination.'.tar.bz2';

        (new FileDownloader($url))
            ->callback(static::makeProgressBar($output))
            ->download($tarBz2);

        $pharData = new PharData($tarBz2);
        $pharData->decompress();

        $pharData = new PharData($tar);
        $pharData->extractTo($destination);

        unlink($tarBz2);
        unlink($tar);

        foreach (new DirectoryIterator($destination) as $fileinfo) {
            if ($fileinfo->isDir() && ! $fileinfo->isDot()) {
                return $fileinfo->getRealPath();
            }
        }

        return $destination;
    }

    /**
     * Make a download progress bar.
     *
     * @return callable
     */
    protected static function makeProgressBar(OutputInterface $output = null)
    {
        return $output ? new Progress(function ($str) use ($output) {
            $output->write($str);
        }) : new Progress;
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

    /**
     * Ensure a directory path is empty.
     *
     * @param string $path
     */
    protected static function ensureEmptyDir($path)
    {
        if (! is_dir($dir = dirname($path))) {
            mkdir($dir, 0777, true);
        }

        if (is_dir($path)) {
            static::rmdir($path);
        }

        if (file_exists($path)) {
            unlink($path);
        }
    }
}
