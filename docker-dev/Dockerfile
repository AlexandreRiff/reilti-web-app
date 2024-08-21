FROM php:8.2-cli-alpine AS php

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin

RUN install-php-extensions \
    zip \
    pdo_pgsql \
    redis

COPY ./configs/upload.ini /usr/local/etc/php/conf.d

COPY --from=composer:lts /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache shadow

ARG HOST_UID=1000
ARG HOST_GID=1000

RUN usermod -u $HOST_UID www-data

COPY ./scripts/docker-entrypoint-php.sh /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

WORKDIR /usr/src/app

USER www-data

EXPOSE 8000

ENTRYPOINT [ "docker-entrypoint.sh" ]

# =======================================================================
FROM node:lts-alpine AS npm

RUN apk add --no-cache shadow

ARG HOST_UID=1000

RUN usermod -u $HOST_UID node

COPY ./scripts/docker-entrypoint-npm.sh /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

WORKDIR /usr/src/app

USER node

EXPOSE 5173

ENTRYPOINT [ "docker-entrypoint.sh" ]
