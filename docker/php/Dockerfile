FROM php:8.1-fpm

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions \
        zip \
        gd \
        intl \
        mbstring \
        pdo_mysql

# Environment settings
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    PATH=/app:/app/vendor/bin:/root/.composer/vendor/bin:$PATH \
    TERM=linux

# Copy wait-for-it script
COPY ./docker/wait-for-it.sh /usr/local/bin/wait-for-it
RUN chmod 555 /usr/local/bin/wait-for-it

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
