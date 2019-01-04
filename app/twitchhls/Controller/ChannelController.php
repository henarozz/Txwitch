<?php
/**
 * TwitchHLS
 * 
 * @author Alexander Makhin <henarozz@gmail.com>
 */
namespace Twitchhls\Controller;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Twitchhls\Component\EasyPDO;
use Twitchhls\Component\TwitchAPI;
use Twitchhls\Mapper\ChannelMapper;

/**
 * ChannelController Class
 * 
 * @package Twitchhls\Controller
 */
class ChannelController
{
    /**
     * DI Container
     * 
     * @Inject
     * @var ContainerInterface 
     */
    protected $container;
    
    /**
     * ChannelMapper
     *
     * @var ChannelMapper
     */
    private $mapper;
    
    /**
     * ChannelController constructor
     * 
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->mapper = new ChannelMapper(
                $this->container->get('db'), 
                $this->container->get('twitchApi')
        );
    }
    
    /**
     * Method to control the action on route </channel>
     * 
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Slim\Views\PhpRenderer
     */
    public function channel(Request $request, Response $response, array $args)
    {
        $channelName = !empty($request->getQueryParam('user_channel')) ? $request->getQueryParam('user_channel') : null;

        $view = $this->container->get('view');
        $channel = $this->mapper->getChannel($channelName);
        
        return $view->render($response, 'channel.phtml', [
            'header' => 'Channel ' . $channelName,
            'channel' => $channel,
        ]);
    }
    
    /**
     * Method to control the action on route </channel/like>
     * 
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function channelLike(Request $request, Response $response, array $args)
    {
        $channelName = !empty($request->getQueryParam('user_channel')) ? $request->getQueryParam('user_channel') : null;
        $userId = !empty($request->getQueryParam('user_id')) ? $request->getQueryParam('user_id') : null;
        
        $data = $this->mapper->addChannelToFavorites($channelName, $userId);
        
        return $response->withJson($data);
    }
    
    /**
     * Method to control the action on route </channel/dislike>
     * 
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function channelDislike(Request $request, Response $response, array $args)
    {
        $channelName = !empty($request->getQueryParam('user_channel')) ? $request->getQueryParam('user_channel') : null;
        
        $data = $this->mapper->deleteChannelFromFavorites($channelName);
        
        return $response->withJson($data);
    }
}

