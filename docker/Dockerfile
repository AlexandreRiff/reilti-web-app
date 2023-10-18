FROM webdevops/php-nginx:8.2-alpine

ENV WEB_DOCUMENT_ROOT=/app/public

WORKDIR /app

COPY . .

RUN composer install \
    --optimize-autoloader

RUN chown -R application:application .

RUN php artisan storage:link
