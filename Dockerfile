FROM php:7.1.1-fpm-alpine

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer

RUN apk update \
    && apk add  --no-cache git mysql-client curl libmcrypt libmcrypt-dev openssh-client \
    libxml2-dev freetype-dev libpng-dev libjpeg-turbo-dev g++ make autoconf

#RUN docker-php-source extract
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug