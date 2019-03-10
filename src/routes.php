<?php
// Routes

// Home route
$app->get('/', Txwitch\Controller\HomeController::class . ':home')->add($checkAuthMiddleware);

// App routes
$app->get('/app/login', Txwitch\Controller\AppController::class . ':login');
$app->post('/app/login', Txwitch\Controller\AppController::class . ':login');
$app->get('/app/logout', Txwitch\Controller\AppController::class . ':logout');

// Games route
$app->get('/games', Txwitch\Controller\GameController::class . ':games')->add($checkAuthMiddleware);

// Streams route
$app->get('/streams', Txwitch\Controller\StreamController::class . ':streams')->add($checkAuthMiddleware);

// Channel routes
$app->get('/channel', Txwitch\Controller\ChannelController::class . ':channel')->add($checkAuthMiddleware);
$app->get('/channel/like', Txwitch\Controller\ChannelController::class . ':channelLike')->add($checkAuthMiddleware);
$app->get('/channel/dislike', Txwitch\Controller\ChannelController::class . ':channelDislike')->add($checkAuthMiddleware);