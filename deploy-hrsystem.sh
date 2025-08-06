#!/bin/bash
set -euo pipefail

APP_DIR="/var/www/hr-dev"

echo "📂 Switching to application directory..."
cd "$APP_DIR"

# Allow Composer to run as root (only if absolutely necessary)
export COMPOSER_ALLOW_SUPERUSER=1

echo "📦 Installing PHP dependencies via Composer..."
composer install --no-interaction --prefer-dist --optimize-autoloader

echo "📁 Creating Laravel storage directories if missing..."
mkdir -p storage/framework/{cache,sessions,views}
mkdir -p storage/logs

# 🛡️ Optional: pre-create the log file to avoid root ownership later
touch storage/logs/laravel.log
chmod 664 storage/logs/laravel.log
chown www-data:www-data storage/logs/laravel.log

echo "🧹 Clearing Laravel caches..."
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan cache:clear || true

echo "⚙️ Running database migrations and seeding..."
php artisan migrate --force
php artisan db:seed --force || echo "⚠️ Seeding failed, skipping..."


echo "📦 Caching Laravel config..."
php artisan config:cache

echo "🔒 Fixing ownership and permissions on full application..."
sudo chown -R www-data:www-data "$APP_DIR"
sudo chmod -R ug+rwX "$APP_DIR"

echo "🔁 Reloading PHP-FPM and NGINX..."
sudo systemctl reload php8.3-fpm || sudo systemctl reload php*-fpm
sudo systemctl reload nginx


sudo chown -R www-data:www-data "$APP_DIR"

echo "✅ Deployment completed successfully!"
