FROM php:7.4-fpm

MAINTAINER Burlang

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions \
        soap \
        zip \
        curl \
        bcmath \
        exif \
        gd \
        iconv \
        intl \
        mbstring \
        opcache \
        pdo_mysql \
        pdo_pgsql \
        imagick \
        mongodb

# Environment settings
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    PATH=/app:/app/vendor/bin:/root/.composer/vendor/bin:$PATH \
    TERM=linux

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
    composer clear-cache

# Install nodejs
RUN apt-get update && apt-get install -y nodejs npm

# Create python symlink
RUN ln -s /usr/bin/python3 /usr/bin/python

# Application environment
WORKDIR /app
