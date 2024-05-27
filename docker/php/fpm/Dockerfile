FROM php:8.1-fpm-alpine

RUN apk add --no-cache mariadb-client icu-dev \
    && docker-php-ext-install pdo_mysql intl

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./docker/php/common/conf.d /usr/local/etc/php/conf.d

WORKDIR /app
