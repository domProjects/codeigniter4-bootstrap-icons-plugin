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

spl_autoload_register(static function (string $class): void {
    $supportPrefix = 'domProjects\\CodeIgniterBootstrapIconsPlugin\\Tests\\Support\\';

    if (str_starts_with($class, $supportPrefix)) {
        $relativePath = str_replace('\\', '/', substr($class, strlen($supportPrefix)));
        $file         = __DIR__ . '/_support/' . $relativePath . '.php';

        if (is_file($file)) {
            require_once $file;
        }

        return;
    }

    $packagePrefix = 'domProjects\\CodeIgniterBootstrapIconsPlugin\\';

    if (! str_starts_with($class, $packagePrefix)) {
        return;
    }

    $relativePath = str_replace('\\', '/', substr($class, strlen($packagePrefix)));
    $file         = __DIR__ . '/../src/' . $relativePath . '.php';

    if (is_file($file)) {
        require_once $file;
    }
}, true, true);

require_once __DIR__ . '/_support/ComposerStubs.php';
require_once __DIR__ . '/_support/Composer/FakeConfig.php';
require_once __DIR__ . '/_support/Composer/FakePackage.php';
require_once __DIR__ . '/_support/Composer/FakeComposer.php';
require_once __DIR__ . '/_support/Composer/FakeIO.php';
require_once __DIR__ . '/_support/Composer/FakeEvent.php';
require_once __DIR__ . '/_support/Composer/TestBootstrapIconsPublishPlugin.php';
