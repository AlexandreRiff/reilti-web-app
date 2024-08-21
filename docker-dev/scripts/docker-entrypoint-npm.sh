#!/bin/sh

init() {
    npm install
    npm run dev -- --host
}

init
