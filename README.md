# domProjects CodeIgniter 4 Bootstrap Icons Plugin

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
