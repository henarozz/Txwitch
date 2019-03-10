<?php
/**
 * Txwitch
 *
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Txwitch\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * HomeController Class
 *
 * @package Txwitch\Controller
 */
class HomeController
{
    /**
     * Method to control the action on route </>
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function home(Request $request, Response $response, array $args)
    {
        return $response->withStatus(302)->withHeader('Location', '/games');
    }
}
