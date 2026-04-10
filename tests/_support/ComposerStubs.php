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

namespace Composer;

class Composer
{
    public function getConfig(): object
    {
        return new class () {
            public function get(string $key): mixed
            {
                return null;
            }
        };
    }

    public function getPackage(): object
    {
        return new class () {
            /**
             * @return array<string, mixed>
             */
            public function getExtra(): array
            {
                return [];
            }
        };
    }
}

namespace Composer\EventDispatcher;

interface EventSubscriberInterface
{
    /**
     * @return array<string, string>
     */
    public static function getSubscribedEvents(): array;
}

namespace Composer\IO;

interface IOInterface
{
    public function write(array|string $messages, bool $newline = true, int $verbosity = 0): void;

    public function writeError(array|string $messages, bool $newline = true, int $verbosity = 0): void;
}

namespace Composer\Plugin;

use Composer\Composer;
use Composer\IO\IOInterface;

interface PluginInterface
{
    public function activate(Composer $composer, IOInterface $io): void;

    public function deactivate(Composer $composer, IOInterface $io): void;

    public function uninstall(Composer $composer, IOInterface $io): void;
}

namespace Composer\Script;

class Event
{
}

final class ScriptEvents
{
    public const POST_INSTALL_CMD = 'post-install-cmd';
    public const POST_UPDATE_CMD  = 'post-update-cmd';
}

namespace Composer\Util;

use Composer\IO\IOInterface;

class ProcessExecutor
{
    public function __construct(private readonly IOInterface $io)
    {
    }

    public function execute(string $command, ?string &$output = null, ?string $cwd = null): int
    {
        $output ??= '';

        return 0;
    }
}
