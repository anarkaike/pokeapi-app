#!/usr/bin/env bash
set -e

cd /var/www/html

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
rm -f public/hot

if [ "${CONTAINER_ROLE:-web}" = "web" ]; then
    php artisan config:clear || true
    php artisan route:clear  || true
    php artisan view:clear   || true
    php artisan cache:clear  || true
fi

exec "$@"
