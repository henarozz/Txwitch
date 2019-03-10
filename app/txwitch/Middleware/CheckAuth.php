<?php

namespace Txwitch\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Txwitch\Component\Security;

/**
 * CheckAuth middleware invokable class
 */
class CheckAuth
{
    /**
     * @var Psr\Container\ContainerInterface
     */
    protected $container;
    
    /**
     * @param \Psr\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param   Psr\Http\Message\ServerRequestInterface     $request    PSR7 request
     * @param   Psr\Http\Message\ResponseInterface          $response   PSR7 response
     * @param   callable                                    $next       Next middleware
     *
     * @return  Psr\Http\Message\ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        /** @var Txwitch\Component\Security */
        $security = $this->container->get('security');
        $backUri = '';
        
        if (!$security->isAuthed()) {
            if (!empty($request->getUri()->getPath())) {
                $backUri = $request->getUri()->getPath() . '?' . $request->getUri()->getQuery();
            }
            $response = $response->withStatus(302)->withHeader('Location', '/app/login?back_uri=' . urlencode($backUri));
        } else {
            $response = $next($request, $response);
        }
        
        return $response;
    }
}
