# IPee IoT webserver

## installation
after cloning this repository, set the correct values to the .env file

To install the back-end
```
composer install
php artisan key:generate
```

create the .env file with at least the next parameters
```
# app setup
APP_NAME=
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=

# db setup (use own database settings, this is an example
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Install npm or yarn for building the assets
```
npm install
or
yarn install
```

building the assets
```
npm run production
or
yarn run production
```

run redis server
```
redis-server # from the root directory of the project
```

run node server
```
nodejs socket.js # from the root directory of the project
```

The prefered way to set up the server is apache, but this can be done with other server technologies like nginx

## minimal requirements

laravel
* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension
* JSON PHP Extension

nodejs
* version 8.x or higher
