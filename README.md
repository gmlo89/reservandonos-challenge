# Reservandonos challenge


## Installation

Assuming you've already installed on your machine: PHP (>= 8.1.0), [Laravel](https://laravel.com), [Composer](https://getcomposer.org) and [Node.js](https://nodejs.org).

``` bash
# install dependencies
composer install
npm install

# create .env file and generate the application key (You need to have a database created)
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan key:generate

# build CSS and JS assets
npm run dev
# or, if you prefer minified files
npm run build
```

Then launch the server:

``` bash
php artisan serve
```

The Laravel sample project is now up and running! Access it at http://localhost:8000.


## Installation with Docker


``` bash
# create .env file
cp .env.example .env

# Run docker-compose
docker-compose up -d --build

# Enter in the bash 
docker exec -it Serve /bin/sh

# Generate a key
php artisan key:generate

# Run migrations
php artisan key:generate

```

The Laravel sample project is now up and running! Access it at http://localhost:8000.

## Testing

Run the next command to run tests
``` bash
 php artisan test
```


## Versions

* Laravel 10.10
* PHP 8.1
* Vue 3.3
* Vite 4.0
* Bootstrap 5.3.2