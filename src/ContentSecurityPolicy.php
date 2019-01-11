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
class ContentSecurityPolicy implements MiddlewareInterface
{
    /**
     * @var array
     */
    protected $policies;

    /**
     * Class constructor
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function __construct(array $policies)
    {
        $this->policies = $policies;
    }

    /**
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function __invoke(Request $request, Response $response)
    {
        $builder = new CSPBuilder($this->policies);
        $headers = $builder->getHeaderArray();
        foreach ($headers as $header => $value) {
            $response->headers->set($header, $value);
        }
    }
}
