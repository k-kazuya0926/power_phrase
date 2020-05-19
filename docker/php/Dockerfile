FROM php:7.1.33-fpm

COPY ./docker/php/php.ini /usr/local/etc/php/
COPY . /var/www

WORKDIR /var/www

RUN apt-get update \
  && apt-get install -y zlib1g-dev mariadb-client unzip \
  && docker-php-ext-install zip pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN composer install

RUN chmod -R a+w storage/ bootstrap/cache
