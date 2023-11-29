#!/usr/bin/env bash

echo "Running composer install..."
composer install --no-dev --working-dir=/var/www/html

echo "Running migrations..."
php artisan migrate --force

echo "Running seeders..."
php artisan db:seed --force