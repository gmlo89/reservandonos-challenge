FROM php:8.1-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql sockets
RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer 

RUN apk add --update npm


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .
RUN composer install  --optimize-autoloader --no-dev; \
    php artisan key:generate --force;
RUN npm install && npm run build
#RUN php artisan migrate