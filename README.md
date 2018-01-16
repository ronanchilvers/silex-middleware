# silex-middleware

A collection of middleware for use with Silex.

## Installation

```bash
composer require ronanchilvers/silex-middleware
```

## Configuration

Configuration details varies depending on the middleware in use. See the notes below for specifics.

## Available Middlewares

* [Content Security Policy](#content-security-policy)
* [Strict Transport Security](#strict-transport-security)

### Content Security Policy

This middleware allows you to add a Content-Security-Policy header to responses. It uses the [```paragonie/csp-builder```](https://github.com/paragonie/csp-builder) library to build the headers. You can pass your policy as an array as the first constructor argument.

```php
$app->after(
    new Ronanchilvers\Silex\Middleware\ContentSecurityPolicy([
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

### Referrer Policy

This middleware adds a [Referrer-Policy](https://www.w3.org/TR/referrer-policy/) header to responses. This header has a single policy directive as its value which must be one of:

 - <empty string>
 - no-referrer
 - no-referrer-when-downgrade
 - same-origin
 - origin
 - strict-origin
 - origin-when-cross-origin
 - strict-origin-when-cross-origin
 - unsafe-url

The exact meaning of each of these is explained [in this blog post by Scott Helme](https://scotthelme.co.uk/a-new-security-header-referrer-policy/) as well as [on the w3.org official specification](https://www.w3.org/TR/referrer-policy/#referrer-policies).

```php
// This adds the middleware with a default 'no-referrer' policy
$app->after(new Ronanchilvers\Silex\ReferrerPolicy());

// This specifies the 'strict-origin' policy
$app->after(new Ronanchilvers\Silex\ReferrerPolicy('strict-origin'));
```

### Strict Transport Security

This middleware adds [HSTS or Strict Transport Security](https://en.wikipedia.org/wiki/HTTP_Strict_Transport_Security) headers to every response.

```php
// Add with defaults
$app->after(new Ronanchilvers\Silex\Middleware\StrictTransportSecurity());

// Or - set the max-age to 1 day / 86400 seconds
$app->after(new Ronanchilvers\Silex\Middleware\StrictTransportSecurity(86400));
```

The middleware accepts two constructor arguments:

  * Max age in seconds - defaults to 15552000 seconds or 6 months
  * Include sub domains - defaults to false
