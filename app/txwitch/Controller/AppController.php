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
use Txwitch\Component\Security;

/**
 * AppController Class
 *
 * @package Txwitch\Controller
 */
class AppController
{
    /**
     * DI Container
     *
     * @Inject
     * @var ContainerInterface
     */
    protected $container;
    
    /**
     * Security component
     *
     * @var Security
     */
    private $security;
    
    /**
     * Settings array
     *
     * @var array
     */
    private $settings;

    /**
     * AppController constructor
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->security = $this->container->get('security');
        $this->settings = $this->container->get('settings');
    }
    
    /**
     * Method to control the actions on route </app/login>
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response|Slim\Views\PhpRenderer
     */
    public function login(Request $request, Response $response, array $args)
    {
        switch ($request->getMethod()) {
            case 'GET':
                $view = $this->container->get('view');
                
                return $view->render(
                    $response,
                    'login.phtml',
                    ['header' => 'Txwitch']
                );
                break;
            case 'POST':
                $trueAuthCredentials = $this->settings['authCredentials'];
                $userAuthCredentials['username'] = $request->getParam('username');
                $userAuthCredentials['password'] = $request->getParam('password');
                
                if ($this->security->passAuth($trueAuthCredentials, $userAuthCredentials)) {
                    $this->security->setAuthSession();
                    $response = $response->withStatus(302)->withHeader('Location', '/games');
                } else {
                    $response = $response->withStatus(302)->withHeader('Location', '/app/login');
                }
                
                return $response;
                break;
            default:
                $response = $response->withStatus(302)->withHeader('Location', '/app/login');
                
                return $response;
                break;
        }
    }
    
    /**
     * Method to control the action on route </app/logout>
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function logout(Request $request, Response $response, array $args)
    {
        $this->security->unsetAuthSession();
        
        return $response->withStatus(302)->withHeader('Location', '/app/login');
    }
}
