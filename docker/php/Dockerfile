FROM php:7.1.33-fpm

COPY ./docker/php/php.ini /usr/local/etc/php/
COPY . /var/www

WORKDIR /var/www

RUN chmod -R a+w storage/ bootstrap/cache

RUN apt-get update \
  && apt-get install -y zlib1g-dev mariadb-client \
  && docker-php-ext-install zip pdo_mysql

#Composer install
COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin
