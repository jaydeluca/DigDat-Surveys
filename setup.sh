#!/usr/bin/env bash
echo "Ensure '$USER' is in www-data group"
sudo usermod -a -G www-data $USER
echo "Set all file permissions to 664"
sudo find . -type f -exec chmod 664 {} \;
echo "Set all directory permissions to 775"
sudo find . -type d -exec chmod 775 {} \;
chmod +x setup.sh
if [ ! -f .env ]; then
  cp .env.example .env
  editor .env
  php artisan key:generate
fi
composer install
yarn
mysql -u root -p"$(grep -E 'DB_PASSWORD=(.*)' .env | sed 's/DB_PASSWORD=//1')" -e 'CREATE DATABASE IF NOT EXISTS dd_surveys'
php artisan migrate
php artisan db:seed
npm run dev
