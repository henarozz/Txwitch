<?php
/**
 * Txwitch
 *
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Txwitch\Controller;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Txwitch\Mapper\GameMapper;

/**
 * GameController Class
 *
 * @package Txwitch\Controller
 */
class GameController
{
    /**
     * DI Container
     *
     * @Inject
     * @var ContainerInterface
     */
    protected $container;
    
    /**
     * GameMapper
     *
     * @var GameMapper
     */
    private $mapper;
    
    /**
     * GameController constructor
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->mapper = new GameMapper(
            $this->container->get('db'),
            $this->container->get('twitchApi')
        );
    }
    
    /**
     * Method to control the action on route </games>
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Slim\Views\PhpRenderer
     */
    public function games(Request $request, Response $response, array $args)
    {
        $view = $this->container->get('view');
        
        $games = $this->mapper->getGames();
        
        return $view->render($response, 'games.phtml', [
            'header' => 'Twitch Top Games',
            'games' => $games
        ]);
    }
}
