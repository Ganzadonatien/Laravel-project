#!/bin/sh

set -e

# Wait for database to be ready
echo "Waiting for database..."
until php artisan migrate:status > /dev/null 2>&1; do
  echo "Database not ready, waiting..."
  sleep 2
done

echo "Generating application key..."
php artisan key:generate --force

echo "Running migrations..."
php artisan migrate --force

echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "Creating storage link..."
php artisan storage:link

echo "Starting PHP-FPM..."
exec php-fpm
