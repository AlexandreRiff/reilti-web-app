#!/bin/sh

ENV_FILE=".env"

update_env() {
    cp .env.example $ENV_FILE

    keys=$(cut -d "=" -f 1 $ENV_FILE)

    for key in $keys; do
        value=$(printenv $key)
        if [ -n "$value" ]; then
            sed -i "s|^${key}=.*|${key}=${value}|g" $ENV_FILE
        fi
    done
}

artisan_commands() {
    php artisan key:generate
    php artisan migrate:fresh --seed
    php artisan optimize:clear
    php artisan serve --host=0.0.0.0 --port=8000
}

init() {
    update_env
    composer install --optimize-autoloader
    artisan_commands
}

init
