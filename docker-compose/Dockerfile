FROM php:7.3-cli-alpine

ENV COMPOSER_CACHE_DIR /tmp

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN find /usr/src -type f -name 'php.tar*' -delete \
    && apk add unzip

VOLUME /app

WORKDIR /app
