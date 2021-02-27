#========================
# Build backend source
#========================
FROM composer as vendor

WORKDIR /app

COPY composer.* /app/
RUN composer install  \
    --ignore-platform-reqs \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scrips \
    --no-suggest \
    --optimize-autoloader \
    --prefer-dist

#========================
# Build app image
#========================
FROM oanhnn/php:7.3-fpm-alpine

WORKDIR /app

COPY                 --chown=www-data:www-data .           /app
COPY --from=vendor   --chown=www-data:www-data /app/vendor /app/vendor
