FROM php:8.1-fpm-alpine

RUN apk add $PHPIZE_DEPS

RUN pecl install xdebug

RUN docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
