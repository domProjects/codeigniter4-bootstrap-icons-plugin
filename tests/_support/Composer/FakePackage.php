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

final class FakePackage
{
    /**
     * @param array<string, mixed> $extra
     */
    public function __construct(private readonly array $extra)
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function getExtra(): array
    {
        return $this->extra;
    }
}
