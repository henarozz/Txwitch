<?php
// DIC configuration
$container = $app->getContainer();

// View renderer
$container['view'] = function ($c) {
    $settings = $c->get('settings')['view'];
    
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    
    return $logger;
};

// Database
$container['db'] = function ($c) {
    $settings = $c->get('settings')['database'];
    $dsn = 'sqlite:' . $settings['host'] . $settings['dbname'];
    $user = $settings['user'];
    $password = $settings['password'];
    $db = new Txwitch\Component\EasyPDO($dsn, $user, $password);
    
    return $db;
};

// HTTP client
$container['httpClient'] = function ($c) {
    return new GuzzleHttp\Client(['verify' => false]);
};

// Twitch API client
$container['twitchApi'] = function ($c) {
    $settings = $c->get('settings')['twitch'];
    $httpClient = $c->get('httpClient');
    $twitchApi = new Txwitch\Component\TwitchAPI($settings, $httpClient);
    
    return $twitchApi;
};

// Security component
$container['security'] = function ($c) {
    $security = new Txwitch\Component\Security();
    
    return $security;
};
