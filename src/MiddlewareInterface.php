<?php

namespace Ronanchilvers\Silex\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface MiddlewareInterface
{
    /**
     * Invoke the middleware
     *
     * @param Symfony\Component\HttpFoundation\Request $request
     * @param Symfony\Component\HttpFoundation\Response $response
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function __invoke(Request $request, Response $response);
}
