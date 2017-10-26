#!/bin/sh
chmod 755 storage/ -R
if [ ! -f .env ]; then
  cp .env.example .env
  editor .env
  php artisan key:generate
fi
composer install
yarn
echo "\nEnter mysql root password to create the database if it doesn't exist"
mysql -u root -p -e 'CREATE DATABASE IF NOT EXISTS dd_surveys'
php artisan migrate
php artisan db:seed
