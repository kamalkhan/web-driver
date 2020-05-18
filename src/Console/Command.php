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

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

abstract class Command extends SymfonyCommand
{
    protected $input;

    protected $output;

    public function setHelp($help)
    {
        return parent::setHelp(preg_replace('/\s+/', ' ', $help));
    }

    abstract protected function handle();

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        return $this->handle();
    }

    protected function call($command, $input = [], $silent = false)
    {
        if (is_string($command)) {
            $command = $this->getApplication()->find($command);
        }

        if (is_array($input)) {
            $input = new ArrayInput($input);
        }

        if (is_string($input)) {
            $input = new StringInput($input);
        }

        return $command->run($input, $silent ? new NullOutput() : $this->output);
    }

    protected function callSilent($command, $input = [])
    {
        return $this->call($command, $input, true);
    }
}
