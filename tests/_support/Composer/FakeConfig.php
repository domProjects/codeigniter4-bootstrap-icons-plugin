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

final class FakeConfig
{
    /**
     * @param array<string, mixed> $values
     */
    public function __construct(private readonly array $values)
    {
    }

    public function get(string $key): mixed
    {
        return $this->values[$key] ?? null;
    }
}
