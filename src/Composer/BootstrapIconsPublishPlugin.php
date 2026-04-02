<?php

namespace domProjects\CodeIgniterBootstrapIconsPlugin\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;
use Composer\Util\ProcessExecutor;

class BootstrapIconsPublishPlugin implements PluginInterface, EventSubscriberInterface
{
    private Composer $composer;
    private IOInterface $io;

    public function activate(Composer $composer, IOInterface $io): void
    {
        $this->composer = $composer;
        $this->io = $io;
    }

    public function deactivate(Composer $composer, IOInterface $io): void
    {
    }

    public function uninstall(Composer $composer, IOInterface $io): void
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ScriptEvents::POST_INSTALL_CMD => 'publishBootstrapIconsAssets',
            ScriptEvents::POST_UPDATE_CMD  => 'publishBootstrapIconsAssets',
        ];
    }

    public function publishBootstrapIconsAssets(Event $event): void
    {
        $rootDir = dirname((string) $this->composer->getConfig()->get('vendor-dir'));
        $spark = $rootDir . DIRECTORY_SEPARATOR . 'spark';

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

        $process = new ProcessExecutor($this->io);
        $output = '';
        $exitCode = $process->execute($command, $output, $rootDir);

        if ($output !== '') {
            $this->io->write(rtrim($output));
        }

        if ($exitCode !== 0) {
            $this->io->writeError('<warning>domProjects Bootstrap Icons Plugin:</warning> automatic asset publishing failed.');
        }
    }

    private function isAutoPublishEnabled(): bool
    {
        $config = $this->getPluginConfig();

        return (bool) ($config['auto-publish'] ?? true);
    }

    private function shouldForcePublish(): bool
    {
        $config = $this->getPluginConfig();

        return (bool) ($config['force'] ?? true);
    }

    /**
     * @return array<string, mixed>
     */
    private function getPluginConfig(): array
    {
        $extra = $this->composer->getPackage()->getExtra();

        $config = $extra['domprojects-codeigniter4-bootstrap-icons-plugin'] ?? [];

        return is_array($config) ? $config : [];
    }
}
