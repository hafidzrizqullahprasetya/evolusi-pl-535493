# Tahap build: siapkan dependensi vendor tanpa paket dev
FROM composer:2.8.5 AS builder

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-scripts \
    --optimize-autoloader

COPY . .

RUN composer dump-autoload --optimize --no-dev

# Tahap runtime: image minimal alpine dengan locked version dan non-root user
FROM php:8.4.26-cli-alpine

WORKDIR /app

RUN docker-php-ext-install -j$(nproc) bcmath

COPY --from=builder /app /app

RUN cp .env.example .env && \
    mkdir -p database storage/framework/sessions storage/framework/views storage/framework/cache storage/logs bootstrap/cache && \
    touch database/database.sqlite && \
    php artisan key:generate && \
    php artisan migrate --force && \
    chown -R www-data:www-data /app && \
    chmod -R 775 /app/storage /app/bootstrap/cache /app/database

USER www-data

EXPOSE 8000

HEALTHCHECK --interval=10s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://127.0.0.1:8000/api/tugas || exit 1

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
