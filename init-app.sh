#!/bin/sh

docker-compose exec app bash -c "XDEBUG_MODE=off composer install"
docker-compose exec app bash -c "npm install"