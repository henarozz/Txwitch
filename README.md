Txwitch
=======
[Txwitch](https://github.com/henarozz/Txwitch) — web application to extract HLS links from [Twitch.tv](https://www.twitch.tv). Based on [PHP Slim Framework 3](http://www.slimframework.com). The application will be useful for old iOS devices.

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
Set your personal Developer Twitch Client ID (you can find it on [dev.twitch.tv](https://dev.twitch.tv))
```php
...
// Twitch API settings
        'twitch' => [
            'clientId' => 'your personal Developer Twitch Client ID',
...
```

Set application authentication credentials
```php
...
// App auth credentials
        'authCredentials' => [
            'username' => 'username',
            'password' => 'strongpassword',
        ],
...
```
### nginx.txwitchhls.conf
```nginx
upstream php56-fpm {
        server 127.0.0.1:9000;
}
server {
        listen 80;
        root /Users/macos/Projects/txwitchhls/public;
        index index.php index.html index.htm;
        server_name txwitchhls.local;

        location / {
                try_files $uri /index.php$is_args$args;
        }

        location ~ \.php$ {
                #try_files $uri =404;
                fastcgi_split_path_info ^(.+\.php)(/.+)$;
                include fastcgi.conf;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                fastcgi_param SCRIPT_NAME $fastcgi_script_name;
                fastcgi_pass php56-fpm;
        }
}
```
### folder permissions
```bash
chown -R www-data:www-data database/
chmod -R 775 database/
mkdir logs/
chown -R www-data:www-data logs/
chmod -R 775 logs/
```

![alt text](https://dl.dropboxusercontent.com/s/kbpec5te8dzi6dl/twitchhls_games.png)
![alt text](https://dl.dropboxusercontent.com/s/xv5lmreubo3prfg/twitchhls_streams.png)
![alt text](https://dl.dropboxusercontent.com/s/h00i34qv5gwjsic/twitchhls_channel.png)
