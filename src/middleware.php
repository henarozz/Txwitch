<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

$checkAuthMiddleware = new Twitchhls\Middleware\CheckAuth($container);
