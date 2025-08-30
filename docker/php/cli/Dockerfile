FROM php:8.3-cli-alpine

RUN apk add --no-cache mariadb-client icu-dev libzip-dev zip \
  && docker-php-ext-install pdo_mysql intl zip

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./docker/php/common/conf.d /usr/local/etc/php/conf.d

RUN apk add --no-cache bash coreutils

COPY ./docker/scripts/wait-for-it.sh /usr/local/bin/wait-for-it
RUN chmod 555 /usr/local/bin/wait-for-it

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet

RUN addgroup -g 1000 app && adduser -u 1000 -G app -s /bin/sh -D app

WORKDIR /app

USER app
