TwitchHLS
=======
TwitchHLS — web application to extract HLS links from Twitch.tv. Based on PHP Slim Framework 3. The application will be useful for old iOS devices.

Requirements
---------------
1. Composer
2. PHP 5.6 or newer
3. PHP extensions: curl, pdo_sqlite, sqlite3, json
4. Nginx/Apache

Getting Started
---------------
1. Clone or download the application from GitHub
2. Install it using Composer

Folder System
---------------
* app/
    * twitchhls/ (PSR-4 Package. Autoload from composer.json)
        * Component/
        * Controller/
        * Mapper/
        * Middleware/
        * Model/
* database/
    * twitchhls.db (Sqlite Database)
* logs/
* public/ (WebRoot Folder)
    * assets/
        * css/
        * img/
        * js/
    * index.php (Index File)
* src/
    * dependencies.php (DI Container Configuration)
    * middleware.php (Application Middleware)
    * routes.php (Application Routes)
    * settings.php (Application Settings)
* templates/

Configuration
---------------
### settings.php
Set your personal Developer Twitch Client ID (you can find it on dev.twitch.tv)
```
...
// Twitch API settings
        'twitch' => [
            'clientId' => 'your personal Developer Twitch Client ID',
...
```

Set application authentication credentials
```
...
// App auth credentials
        'authCredentials' => [
            'username' => 'username',
            'password' => 'strongpassword',
        ],
...
```

![alt text](https://dl.dropboxusercontent.com/s/kbpec5te8dzi6dl/twitchhls_games.png)
![alt text](https://dl.dropboxusercontent.com/s/xv5lmreubo3prfg/twitchhls_streams.png)
![alt text](https://dl.dropboxusercontent.com/s/h00i34qv5gwjsic/twitchhls_channel.png)
