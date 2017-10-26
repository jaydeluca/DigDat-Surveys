#!/bin/sh
sudo usermod -a -G www-data $USER
sudo find . -type f -exec chmod 664 {} \;
sudo find . -type d -exec chmod 755 {} \;
chmod +x setup.sh
if [ ! -f .env ]; then
  cp .env.example .env
  editor .env
  php artisan key:generate
fi
composer install
yarn
echo "\nEnter mysql root password to create the database if it doesn't exist"
mysql -u root -p"$(grep -E 'DB_PASSWORD=(.*)' .env | sed 's/DB_PASSWORD=//1')" -e 'CREATE DATABASE IF NOT EXISTS dd_surveys'
php artisan migrate
php artisan db:seed
