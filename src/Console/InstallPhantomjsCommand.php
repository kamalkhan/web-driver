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

class InstallPhantomjsCommand extends InstallDriverCommand
{
    /**
     * URL to the phantomjs download.
     *
     * @var string
     */
    protected $downloadUrl = 'https://bitbucket.org/ariya/phantomjs/downloads/phantomjs-%s-%s.zip';

    /**
     * The latest version available.
     *
     * @var string
     */
    protected $latestVersion = '2.1.1';

    /**
     * Download slugs for the available operating systems.
     *
     * @var array
     */
    protected $slugs = [
        'linux' => 'linux-x86_64',
        'mac' => 'macosx',
        'win' => 'windows',
    ];

    /** {@inheritdoc} */
    protected function configure()
    {
        $this->setName('install');
        $this->setDescription('Install a phantomjs driver.');
        $this->setHelp('Installs a phantomjs driver for use with the phantomjs web driver.');

        $this->addArgument(
            'version',
            InputArgument::OPTIONAL,
            'Version to install',
            $this->getLatestVersion()
        );
    }

    /** {@inheritdoc} */
    protected function handle()
    {
        $version = $this->getVersion();
        $os = static::getCurrentOS();
        $slug = $this->slugs[$os];
        $url = sprintf($this->downloadUrl, $version, $slug);
        $destination = $this->getDestination();
        $compiledDestination = $this->getCompiledDestination();

        static::download($url, $destination, $this->output);

        $name = $this->getDriverName().static::getOSExtension();
        $tmpName = '_'.$name;
        copy($destination.'/bin/'.$name, $this->destination.'/'.$tmpName);
        static::rmdir($destination);
        rename($this->destination.'/'.$tmpName, $compiledDestination);

        chmod($compiledDestination, 0777);

        $this->output->writeln('');

        $this->output->writeln("<info>Installed phantomjs driver</> <comment>{$version}</>");
    }

    /** {@inheritdoc} */
    protected function getDriverName()
    {
        return 'phantomjs';
    }

    /**
     * {@inheritdoc}
     *
     * Get the latest phantomjs driver version.
     */
    protected function getLatestVersion()
    {
        return $this->latestVersion;
    }
}
