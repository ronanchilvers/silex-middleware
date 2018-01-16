<?php

namespace Ronanchilvers\Silex\Middleware;

use Ronanchilvers\Silex\Middleware\MiddlewareInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Add a Referer Policy header
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class ReferrerPolicy implements MiddlewareInterface
{
    /**
     * @var string
     */
    const VALID_POLICIES = [
        "",
        "no-referrer",
        "no-referrer-when-downgrade",
        "same-origin",
        "origin",
        "strict-origin",
        "origin-when-cross-origin",
        "strict-origin-when-cross-origin",
        "unsafe-url",
    ];

    /**
     * @var string
     */
    protected $policy;

    /**
     * Class constructor
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function __construct($policy = 'no-referrer')
    {
        if (!in_array($policy, static::VALID_POLICIES)) {
            $policy = 'no-referrer';
        }
        $this->policy = $policy;
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
        $response->headers->set('Referrer-Policy', $this->policy);
    }
}
