# Bootstrap Icons Plugin for CodeIgniter 4

[![Packagist](https://img.shields.io/packagist/v/domprojects/codeigniter4-bootstrap-icons-plugin?label=Packagist)](https://packagist.org/packages/domprojects/codeigniter4-bootstrap-icons-plugin)
[![License](https://img.shields.io/github/license/domProjects/codeigniter4-bootstrap-icons-plugin)](https://github.com/domProjects/codeigniter4-bootstrap-icons-plugin/blob/main/LICENSE)
[![PHPUnit](https://img.shields.io/github/actions/workflow/status/domProjects/codeigniter4-bootstrap-icons-plugin/phpunit.yml?branch=main&label=PHPUnit)](https://github.com/domProjects/codeigniter4-bootstrap-icons-plugin/actions/workflows/phpunit.yml)
[![Psalm](https://img.shields.io/github/actions/workflow/status/domProjects/codeigniter4-bootstrap-icons-plugin/psalm.yml?branch=main&label=Psalm)](https://github.com/domProjects/codeigniter4-bootstrap-icons-plugin/actions/workflows/psalm.yml)
[![PHPStan](https://img.shields.io/github/actions/workflow/status/domProjects/codeigniter4-bootstrap-icons-plugin/phpstan.yml?branch=main&label=PHPStan)](https://github.com/domProjects/codeigniter4-bootstrap-icons-plugin/actions/workflows/phpstan.yml)

Composer plugin that automatically publishes domProjects CodeIgniter 4 Bootstrap Icons assets.

## Features

- Runs after `composer install`
- Runs after `composer update`
- Automatically executes `php spark assets:publish-bootstrap-icons`
- Supports automatic overwrite configuration

## Installation

Install the plugin with Composer:

```bash
composer require domprojects/codeigniter4-bootstrap-icons-plugin
```

Composer plugin execution must be allowed in the consuming project:

```json
{
    "config": {
        "allow-plugins": {
            "domprojects/codeigniter4-bootstrap-icons-plugin": true
        }
    }
}
```

## Configuration

Optional Composer configuration:

```json
{
    "extra": {
        "domprojects-codeigniter4-bootstrap-icons-plugin": {
            "auto-publish": true,
            "force": true
        }
    }
}
```

## License

MIT
