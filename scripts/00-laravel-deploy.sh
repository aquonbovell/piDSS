#!/usr/bin/env bash

echo "Running composer install..."
composer install --no-dev --working-dir=/var/www/html

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

# echo "Running seeders..."
# php artisan migrate:fresh --seed --force