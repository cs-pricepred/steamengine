#!/bin/sh
set -e

echo "Deploying application ..."

# Enter maintenance mode
(php artisan down --message 'The app is being currently updated. Please try again in a minute.') || true
    # Update codebase
    git fetch origin main
    git reset --hard origin/main

    # Install dependencies based on lock file
    composer install --no-interaction --prefer-dist --optimize-autoloader

    # install npm packages
    npm install

    # build assets etc.
    npm run build

    # Migrate database
    php artisan migrate --force

    # start schedule worker
    php artisan schedule:work

    # Clear cache
    php artisan optimize

    # Reload PHP to update opcache
    echo "" | sudo -S service php7.4-fpm reload
# Exit maintenance mode
php artisan up

echo "Application deployed!"
