<?php

namespace Ronanchilvers\Silex\Middleware;

use Ronanchilvers\Silex\Middleware\MiddlewareInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware to add HSTS headers
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class Hsts implements MiddlewareInterface
{
    /**
     * @var int
     */
    protected $maxAgeInSeconds;

    /**
     * @var boolean
     */
    protected $includeSubDomains = false;

    /**
     * Class constructor
     *
     * @param int $maxAgeInSeconds Defaults to 6 months or 15,552,000 seconds
     * @param boolean $includeSubDomains
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function __construct($maxAgeInSeconds = 15552000, $includeSubDomains = false)
    {
        $this->maxAgeInSeconds = (int) $maxAgeInSeconds;
        $this->includeSubDomains = $includeSubDomains;
    }

    /**
     * Magic invocation method
     *
     * @param Symfony\Component\HttpFoundation\Request
     * @param Silex\Application
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function __invoke(Request $request, Response $response)
    {
        if (0 == $this->maxAgeInSeconds) {
            return;
        }
        $value = [];
        $value[] = sprintf('max-age=%d', $this->maxAgeInSeconds);
        if ($this->includeSubDomains) {
            $value[] = ' includeSubDomains';
        }
        $value = implode(';', $value);
        $response->headers->set('Strict-Transport-Security', $value);
    }
}
