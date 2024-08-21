#!/bin/sh

DOCKER_COMPOSE_FILE="./docker-dev/docker-compose.yml"

add_vars() {
    export HOST_UID=$(id -u)
}

run_docker() {
    stop_docker
    docker compose -f $DOCKER_COMPOSE_FILE up -d --build
}

stop_docker() {
    docker compose -f $DOCKER_COMPOSE_FILE down
}

start() {
    add_vars

    if [ "$1" = "stop" ]; then
        stop_docker
    else
        run_docker
    fi
}

start "$@"
