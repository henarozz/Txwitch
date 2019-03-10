<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

$checkAuthMiddleware = new Txwitch\Middleware\CheckAuth($container);
