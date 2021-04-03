FROM php:5.6-apache
LABEL maintainer="Kilderson Sena <dersonsena@gmail.com>"

ENV COMPOSER_VERSION=2.0.9

RUN docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install json

RUN rm -rf /var/cache/apk/*

RUN curl -sS https://getcomposer.org/installer | php -- --version=${COMPOSER_VERSION} --install-dir=/usr/bin --filename=composer

EXPOSE 80 443

WORKDIR /var/www/html