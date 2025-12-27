#!/usr/bin/env bash
set -e

cd /var/www/html

if [ ! -f .env ]; then
  cp .env.example .env
fi

if [ ! -d vendor ]; then
  composer install --no-interaction --prefer-dist
fi

if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force
fi

if [ -n "$DB_HOST" ] && [ -n "$DB_PORT" ]; then
  echo "Waiting for database at ${DB_HOST}:${DB_PORT}..."
  for i in {1..30}; do
    if nc -z "$DB_HOST" "$DB_PORT"; then
      break
    fi
    sleep 1
  done
fi

if [ -n "$DB_HOST" ]; then
  php artisan migrate --force
fi

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

exec "$@"
