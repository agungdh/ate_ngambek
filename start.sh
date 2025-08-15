#!/bin/sh
set -eu
cd /var/www/html

php artisan optimize

exec php artisan octane:start
