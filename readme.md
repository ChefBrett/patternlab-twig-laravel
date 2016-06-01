# Requirements

Laravel >= 5
TwigBridge >= 0.7

# Installation

```bash
composer require daspete/patternlab-twig-laravel
```

# Quickstart

Once you have installed the package, you need to register it and its dependencies in your app config -> /config/app.php

add following lines to your 'providers' array:

```php
    TwigBridge\ServiceProvider::class,
    Daspete\Laravel\ServiceProvider::class,
```

and add the TwigBridge Facade to your 'aliases' array:

```php
    'Twig' => TwigBridge\Facade\Twig::class,
```

after that, you need to publish the configs of this package and of the TwigBridge package:

```php
    php artisan vendor:publish --provider="TwigBridge\ServiceProvider"
    php artisan vendor:publish --provider="Daspete\Laravel\ServiceProvider"
```

and edit the new config in /config/twigbridge.php, insert the patternlab extension into the 'extension' array:

```php
'extensions' => [
    ...
    'enabled' => [
        ...
        'Daspete\Laravel\Patternlab',
    ],
]
```