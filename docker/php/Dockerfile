FROM php:7.1.33-fpm

COPY ./docker/php/php.ini /usr/local/etc/php/

# 開発環境の場合はマウント。これはうまく動かないのでdocker-compoase.ymlで設定
# VOLUME .:/var/www
# 本番環境の場合はファイルをコピーする必要がある
# COPY . /var/www

WORKDIR /var/www

RUN apt-get update \
  && apt-get install -y zlib1g-dev mariadb-client unzip \
  && docker-php-ext-install zip pdo_mysql

# 本番環境の場合、composerでパッケージをインストール
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
# RUN composer install

# 本番環境の場合、パーミッション変更
# RUN chmod -R a+w storage/ bootstrap/cache
