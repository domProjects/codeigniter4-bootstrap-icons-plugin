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

use Composer\Composer;

final class FakeComposer extends Composer
{
    public function __construct(
        private readonly FakeConfig $config,
        private readonly FakePackage $package,
    ) {
    }

    public function getConfig(): object
    {
        return $this->config;
    }

    public function getPackage(): object
    {
        return $this->package;
    }
}
