#! /bin/bash

git fetch ssh-origin main

git pull ssh-origin main

npm i

npm run prod

composer install --no-interaction

php artisan migrate

php artisan config:clear

php artisan view:clear

php artisan route:clear
