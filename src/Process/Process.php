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

use Symfony\Component\Process\Process as SymfonyProcess;

abstract class Process implements Contract
{
    /**
     * Driver binary path.
     *
     * @var string
     */
    protected $binary;

    /**
     * Driver port.
     *
     * @var int
     */
    protected $port = 9515;

    /**
     * Driver URL.
     *
     * @var string
     */
    protected $url;

    /**
     * Symfony process.
     *
     * @var SymfonyProcess
     */
    protected $process;

    /**
     * Construct the instance.
     *
     * @param string $binary
     * @param int    $port
     */
    public function __construct($binary, $port = null)
    {
        $this->binary($binary ?: $this->binary);
        $this->port($port ?: $this->port);

        register_shutdown_function([$this, 'stop']);
    }

    /** Terminate the process. */
    public function __destruct()
    {
        $this->stop();
    }

    /**
     * Set the driver binary.
     *
     * @param string $binary
     *
     * @return Contract
     */
    public function binary($binary)
    {
        $this->binary = realpath($binary);

        return $this;
    }

    /**
     * Set the driver port.
     *
     * @param int $port
     *
     * @return Contract
     */
    public function port($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @param int|null $wait
     */
    public function start($wait = null)
    {
        if (! $this->isRunning()) {
            $this->process = $this->makeProcess();

            $this->process->start();

            if ($wait) {
                usleep(($wait) * 1000);
            }
        }
    }

    /** {@inheritdoc} */
    public function stop()
    {
        if ($this->isRunning()) {
            $this->process->stop();
        }

        $this->process = null;
    }

    /** {@inheritdoc} */
    public function isRunning()
    {
        return $this->process && $this->process->isRunning();
    }

    /** {@inheritdoc} */
    public function getUrl()
    {
        return $this->url ?: rtrim('http://localhost:'.$this->port, ':');
    }

    /**
     * Make the Symfony process.
     *
     * @return SymfonyProcess
     */
    protected function makeProcess()
    {
        return new SymfonyProcess($this->getCommand(), $this->getCwd(), $this->getEnv());
    }

    /**
     * Get the process environment variables.
     *
     * @return array
     */
    protected function getEnv()
    {
        return [];
    }

    /**
     * Get the process current working directory.
     *
     * @return string|null
     */
    protected function getCwd()
    {
    }

    /**
     * Get the process command.
     *
     * @return string|array
     */
    abstract protected function getCommand();
}
