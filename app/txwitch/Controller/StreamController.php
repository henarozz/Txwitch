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
use Txwitch\Mapper\StreamMapper;
use Txwitch\Mapper\ChannelMapper;

/**
 * StreamController Class
 * 
 * @package Txwitch\Controller
 */
class StreamController
{
    /**
     * DI Container
     * 
     * @Inject
     * @var ContainerInterface 
     */
    protected $container;
    
    /**
     * StreamMapper
     *
     * @var StreamMapper
     */
    private $mapper;
    
    /**
     * StreamController constructor
     * 
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->mapper = new StreamMapper(
                $this->container->get('db'), 
                $this->container->get('twitchApi')
        );
    }
    
    /**
     * Method to control the action on route </streams>
     * 
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Slim\Views\PhpRenderer
     */
    public function streams(Request $request, Response $response, array $args)
    {
        $gameId = !empty($request->getQueryParam('game_id')) ? $request->getQueryParam('game_id') : null;
        $lang = !empty($request->getQueryParam('lang')) ? $request->getQueryParam('lang') : null;
        
        $view = $this->container->get('view');
        
        $streams = $this->mapper->getStreams($gameId, $lang);
        
        $channelMapper = new ChannelMapper($this->container->get('db'), $this->container->get('twitchApi'));
        $favorites = $channelMapper->getFavoriteChannels();
        
        return $view->render($response, 'streams.phtml', [
            'header' => 'Live Streams',
            'streams' => $streams,
            'favorites' => $favorites
        ]);
    }
}
