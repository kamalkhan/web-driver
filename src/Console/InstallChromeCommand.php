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

use Symfony\Component\Console\Input\InputArgument;

/**
 * @see https://github.com/staudenmeir/dusk-updater/blob/v1.2/src/UpdateCommand.php
 * @see https://github.com/laravel/dusk/blob/6.x/src/Console/ChromeDriverCommand.php
 */
class InstallChromeCommand extends InstallDriverCommand
{
    /**
     * URL to the latest stable release version.
     *
     * @var string
     */
    protected $latestVersionUrl = 'https://chromedriver.storage.googleapis.com/LATEST_RELEASE';

    /**
     * URL to the latest release version for a major Chrome version.
     *
     * @var string
     */
    protected $versionUrl = 'https://chromedriver.storage.googleapis.com/LATEST_RELEASE_%d';

    /**
     * URL to the ChromeDriver download.
     *
     * @var string
     */
    protected $downloadUrl = 'https://chromedriver.storage.googleapis.com/%s/chromedriver_%s.zip';

    /**
     * Download slugs for the available operating systems.
     *
     * @var array
     */
    protected $slugs = [
        'linux' => 'linux64',
        'mac' => 'mac64',
        'win' => 'win32',
    ];

    /**
     * The legacy versions for the ChromeDriver.
     *
     * @var array
     */
    protected $legacyVersions = [
        43 => '2.20',
        44 => '2.20',
        45 => '2.20',
        46 => '2.21',
        47 => '2.21',
        48 => '2.21',
        49 => '2.22',
        50 => '2.22',
        51 => '2.23',
        52 => '2.24',
        53 => '2.26',
        54 => '2.27',
        55 => '2.28',
        56 => '2.29',
        57 => '2.29',
        58 => '2.31',
        59 => '2.32',
        60 => '2.33',
        61 => '2.34',
        62 => '2.35',
        63 => '2.36',
        64 => '2.37',
        65 => '2.38',
        66 => '2.40',
        67 => '2.41',
        68 => '2.42',
        69 => '2.44',
    ];

    /** {@inheritdoc} */
    protected function configure()
    {
        $this->setName('install');
        $this->setDescription('Install a chrome driver.');
        $this->setHelp('Installs a chrome driver for use with the chrome web driver.');

        $this->addArgument(
            'version',
            InputArgument::OPTIONAL,
            'Version to install'
        );
    }

    /** {@inheritdoc} */
    protected function handle()
    {
        $version = $this->getVersion();
        $os = $this->getCurrentOS();
        $slug = $this->slugs[$os];
        $url = sprintf($this->downloadUrl, $version, $slug);
        $compiledDestination = $this->getCompiledDestination();

        static::download($url, $compiledDestination, $this->output);

        chmod($compiledDestination, 0777);

        $this->output->writeln('');

        $this->output->writeln("<info>Installed chrome driver</> <comment>{$version}</>");
    }

    /** {@inheritdoc} */
    protected function getDriverName()
    {
        return 'chrome';
    }

    /**
     * {@inheritdoc}
     *
     * Get the desired chrome driver version.
     */
    protected function getVersion()
    {
        $version = parent::getVersion();

        if (! ctype_digit($version)) {
            return $version;
        }

        $version = (int) $version;

        if ($version < 70) {
            return $this->legacyVersions[$version];
        }

        return trim(file_get_contents(
            sprintf($this->versionUrl, $version)
        ));
    }

    /**
     * {@inheritdoc}
     *
     * Get the latest stable chrome driver version.
     */
    protected function getLatestVersion()
    {
        return trim(file_get_contents($this->latestVersionUrl));
    }
}
