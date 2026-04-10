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

namespace domProjects\CodeIgniterBootstrapIconsPlugin\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;
use Composer\Util\ProcessExecutor;
use RuntimeException;

/**
 * Composer plugin that automatically publishes Bootstrap Icons assets after install/update.
 */
class BootstrapIconsPublishPlugin implements PluginInterface, EventSubscriberInterface
{
    /**
     * Active Composer instance provided during plugin activation.
     */
    private ?Composer $composer = null;

    /**
     * Composer IO used to report plugin activity and failures.
     */
    private ?IOInterface $io = null;

    /**
     * Stores the Composer and IO instances used by the plugin.
     */
    public function activate(Composer $composer, IOInterface $io): void
    {
        $this->composer = $composer;
        $this->io       = $io;
    }

    /**
     * No persistent state is kept, so there is nothing to tear down here.
     */
    public function deactivate(Composer $composer, IOInterface $io): void
    {
    }

    /**
     * No uninstall cleanup is required because the plugin only triggers a command.
     */
    public function uninstall(Composer $composer, IOInterface $io): void
    {
    }

    /**
     * Subscribes the plugin to Composer install/update completion events.
     *
     * @return array<string, string>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ScriptEvents::POST_INSTALL_CMD => 'publishBootstrapIconsAssets',
            ScriptEvents::POST_UPDATE_CMD  => 'publishBootstrapIconsAssets',
        ];
    }

    /**
     * Runs the Spark command that publishes Bootstrap Icons assets when enabled.
     *
     * The plugin resolves the project root from Composer's `vendor-dir`
     * setting, looks for the application's `spark` entry point, and then
     * executes `assets:publish-bootstrap-icons` with the configured options.
     */
    public function publishBootstrapIconsAssets(Event $event): void
    {
        if ($this->composer === null || $this->io === null) {
            return;
        }

        $rootDir = dirname((string) $this->composer->getConfig()->get('vendor-dir'));
        $spark   = $rootDir . DIRECTORY_SEPARATOR . 'spark';

        if (! is_file($spark)) {
            return;
        }

        if (! $this->isAutoPublishEnabled()) {
            $this->io->write('<info>domProjects Bootstrap Icons Plugin:</info> automatic asset publishing disabled.');

            return;
        }

        $command = escapeshellarg(PHP_BINARY)
            . ' '
            . escapeshellarg($spark)
            . ' assets:publish-bootstrap-icons'
            . ($this->shouldForcePublish() ? ' --force' : '');

        $this->io->write('<info>domProjects Bootstrap Icons Plugin:</info> publishing Bootstrap Icons assets...');

        $process  = $this->createProcessExecutor();
        $output   = '';
        $exitCode = $this->executeCommand($process, $command, $output, $rootDir);

        if ($output !== '') {
            $this->io->write(rtrim((string) $output));
        }

        if ($exitCode !== 0) {
            $this->io->writeError('<warning>domProjects Bootstrap Icons Plugin:</warning> automatic asset publishing failed.');
        }
    }

    /**
     * Creates the process executor used to run the Spark command.
     */
    protected function createProcessExecutor(): ProcessExecutor
    {
        if ($this->io === null) {
            throw new RuntimeException('Composer IO is not available before plugin activation.');
        }

        return new ProcessExecutor($this->io);
    }

    /**
     * Executes the publication command in the project root directory.
     *
     * Keeping command execution behind a dedicated method makes the plugin
     * easier to test without launching a real external process.
     *
     * @param ?string $output Command output buffer populated by the process executor.
     */
    protected function executeCommand(ProcessExecutor $process, string $command, ?string &$output, string $rootDir): int
    {
        return $process->execute($command, $output, $rootDir);
    }

    /**
     * Returns whether automatic publication is enabled in `composer.json`.
     *
     * Defaults to `true` when the option is omitted.
     */
    private function isAutoPublishEnabled(): bool
    {
        $config = $this->getPluginConfig();

        return (bool) ($config['auto-publish'] ?? true);
    }

    /**
     * Returns whether the automatic publication should overwrite existing files.
     *
     * Defaults to `true` when the option is omitted.
     */
    private function shouldForcePublish(): bool
    {
        $config = $this->getPluginConfig();

        return (bool) ($config['force'] ?? true);
    }

    /**
     * Reads this plugin's configuration from the root package `extra` section.
     *
     * Expected shape:
     * `extra.domprojects-codeigniter4-bootstrap-icons-plugin.auto-publish`
     * `extra.domprojects-codeigniter4-bootstrap-icons-plugin.force`
     *
     * @return array<string, mixed>
     */
    private function getPluginConfig(): array
    {
        if ($this->composer === null) {
            return [];
        }

        $extra = $this->composer->getPackage()->getExtra();

        $config = $extra['domprojects-codeigniter4-bootstrap-icons-plugin'] ?? [];

        return is_array($config) ? $config : [];
    }
}
