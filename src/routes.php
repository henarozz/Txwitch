<?php
// Routes

// Home route
$app->get('/', Twitchhls\Controller\HomeController::class . ':home')->add($checkAuthMiddleware);

// App routes
$app->get('/app/login', Twitchhls\Controller\AppController::class . ':login');
$app->post('/app/login', Twitchhls\Controller\AppController::class . ':login');
$app->get('/app/logout', Twitchhls\Controller\AppController::class . ':logout');

// Games route
$app->get('/games', Twitchhls\Controller\GameController::class . ':games')->add($checkAuthMiddleware);

// Streams route
$app->get('/streams', Twitchhls\Controller\StreamController::class . ':streams')->add($checkAuthMiddleware);

// Channel routes
$app->get('/channel', Twitchhls\Controller\ChannelController::class . ':channel')->add($checkAuthMiddleware);
$app->get('/channel/like', Twitchhls\Controller\ChannelController::class . ':channelLike')->add($checkAuthMiddleware);
$app->get('/channel/dislike', Twitchhls\Controller\ChannelController::class . ':channelDislike')->add($checkAuthMiddleware);