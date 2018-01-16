<?php

namespace Ronanchilvers\Silex\Middleware;

use ParagonIE\CSPBuilder\CSPBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Add CSP / Content Security Policy headers
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class Csp implements MiddlewareInterface
{
    /**
     * @var ParagonIE\CSPBuilder\CSPBuilder
     */
    protected $builder;

    /**
     * Class constructor
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function __construct(array $policies)
    {
        $this->builder = new CSPBuilder($policies);
    }

    /**
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function __invoke(Request $request, Response $response)
    {
        $headers = $this->builder->getHeaderArray();
        foreach ($headers as $header => $value) {
            $response->headers->set($header, $value);
        }
    }
}
