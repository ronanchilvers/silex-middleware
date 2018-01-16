# silex-middleware

A collection of middleware for use with Silex.

## Installation

```bash
composer require ronanchilvers/silex-middleware
```

## Configuration

Configuration details varies depending on the middleware in use. See the notes below for specifics.

## Available Middlewares

* [CSP (Content Security Policy)](#csp)
* [HSTS (Strict Transport Security)](#hsts)

### CSP

This middleware allows you to add a Content-Security-Policy header to responses. It uses the [```paragonie/csp-builder```](https://github.com/paragonie/csp-builder) library to build the headers. You can pass your policy as an array as the first constructor argument.

```php
$app->after(
    new Ronanchilvers\Silex\Middleware\Csp([
        'default-src' => [
            'self' => true,
            'unsafe-inline' => true,
        ],
        'style-src' => [
            'allow' => [
                'https://fonts.googleapis.com'
            ],
            'self' => true,
            'unsafe-inline' => true,
        ],
        'font-src' => [
            'allow' => [
                'https://fonts.gstatic.com/'
            ],
            'self' => true
        ],
        'report-only' => true,
    ])
);
```

### HSTS

This middleware adds [HSTS or Strict Transport Security](https://en.wikipedia.org/wiki/HTTP_Strict_Transport_Security) headers to every response.

```php
// Add with defaults
$app->after(new Ronanchilvers\Silex\Middleware\Hsts());

// Or - set the max-age to 1 day / 86400 seconds
$app->after(new Ronanchilvers\Silex\Middleware\Hsts(86400));
```

The middleware accepts two constructor arguments:

  * Max age in seconds - defaults to 15552000 seconds or 6 months
  * Include sub domains - defaults to false
