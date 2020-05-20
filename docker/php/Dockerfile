FROM php:7.1.33-fpm

COPY ./docker/php/php.ini /usr/local/etc/php/

WORKDIR /var/www

RUN apt-get update \
  && apt-get install -y zlib1g-dev mariadb-client unzip \
  && docker-php-ext-install zip pdo_mysql
