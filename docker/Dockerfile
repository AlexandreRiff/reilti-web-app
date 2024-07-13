FROM php:8.2-cli-alpine as cli

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin

RUN install-php-extensions \
    zip \
    pdo_pgsql

COPY --from=composer:lts /usr/bin/composer /usr/bin/composer

WORKDIR /usr/src/app

COPY . .

RUN composer install --optimize-autoloader --no-dev

# =======================================================================
FROM node:lts-alpine as frontend

WORKDIR /usr/src/app

COPY . .

RUN npm install \
    && npm run build

# =======================================================================
FROM php:8.2-fpm-alpine as php

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin

RUN install-php-extensions \
    zip \
    gd \
    pdo_pgsql

COPY docker/configs/upload.ini /usr/local/etc/php/conf.d

WORKDIR /var/www/html

COPY --from=cli --chown=www-data:www-data /usr/src/app .

COPY --from=frontend --chown=www-data:www-data /usr/src/app/public ./public

# =======================================================================
FROM nginx:stable-alpine as web

COPY docker/configs/nginx.conf.template /etc/nginx/templates/default.conf.template

WORKDIR /var/www/html/public

COPY --from=frontend /usr/src/app/public .

RUN chgrp -R www-data ./storage && chmod -R g+w ./storage
