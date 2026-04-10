<?php

declare(strict_types=1);

/**
 * This file is part of domprojects/codeigniter4-bootstrap-icons-plugin.
 *
 * (c) domProjects
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace domProjects\CodeIgniterBootstrapIconsPlugin\Tests\Support\Composer;

use Composer\Util\ProcessExecutor;
use domProjects\CodeIgniterBootstrapIconsPlugin\Composer\BootstrapIconsPublishPlugin;
use RuntimeException;

final class TestBootstrapIconsPublishPlugin extends BootstrapIconsPublishPlugin
{
    private ?string $lastCommand = null;
    private int $nextExitCode    = 0;
    private string $nextOutput   = '';
    private ?FakeIO $io          = null;

    public function setIo(FakeIO $io): void
    {
        $this->io = $io;
    }

    public function setNextExecutionResult(int $exitCode, string $output): void
    {
        $this->nextExitCode = $exitCode;
        $this->nextOutput   = $output;
    }

    public function getLastCommand(): ?string
    {
        return $this->lastCommand;
    }

    public function getIo(): FakeIO
    {
        if ($this->io === null) {
            throw new RuntimeException('Fake IO has not been configured.');
        }

        return $this->io;
    }

    protected function createProcessExecutor(): ProcessExecutor
    {
        return new ProcessExecutor($this->getIo());
    }

    protected function executeCommand(ProcessExecutor $process, string $command, ?string &$output, string $rootDir): int
    {
        $this->lastCommand = $command;
        $output            = $this->nextOutput;

        return $this->nextExitCode;
    }
}
