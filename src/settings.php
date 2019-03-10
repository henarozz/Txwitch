<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'view' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'txwitch-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database settings
        'database' => [
            'host' => __DIR__ . '/../database/',
            'port' => '',
            'dbname' => 'txwitch.db',
            'user' => '',
            'password' => '',
            'charset' => '',
        ],

        // Twitch API settings
        'twitch' => [
            'clientId' => '',
            'usherUrl' => 'https://usher.twitch.tv/api/channel/hls/{user_channel}.m3u8?player=twitchweb'.
								'&token={token}'.
								'&sig={sig}'.
								'&$allow_audio_only=true&allow_source=true&type=any&p={random}',
            'tokenUrl' => 'https://api.twitch.tv/api/channels/{user_channel}/access_token?client_id={clientId}',
            'gameUrl' => 'https://api.twitch.tv/helix/games/top?first=100',
            'streamUrl' => 'https://api.twitch.tv/helix/streams?first=100',
            'thumbSize' => ['width' => 320, 'height' => 240]
        ],

        // App auth credentials
        'authCredentials' => [
            'username' => 'username',
            'password' => 'password',
        ],
    ],
];
