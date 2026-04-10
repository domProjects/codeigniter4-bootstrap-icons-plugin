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

use Composer\IO\IOInterface;

final class FakeIO implements IOInterface
{
    /**
     * @var list<string>
     */
    public array $writes = [];

    /**
     * @var list<string>
     */
    public array $errors = [];

    public function write(array|string $messages, bool $newline = true, int $verbosity = 0): void
    {
        foreach ((array) $messages as $message) {
            $this->writes[] = (string) $message;
        }
    }

    public function writeError(array|string $messages, bool $newline = true, int $verbosity = 0): void
    {
        foreach ((array) $messages as $message) {
            $this->errors[] = (string) $message;
        }
    }
}
