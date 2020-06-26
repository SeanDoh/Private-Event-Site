FROM php:7.2-apache

RUN apt-get update && apt-get install -y libicu-dev zip unzip \
    && docker-php-ext-install -j$(nproc) intl mysqli \
    && a2enmod rewrite && service apache2 restart \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer && rm composer-setup.php

COPY ./code /var/www/html/

RUN cd /var/www/html && composer install \
    && chown -R www-data:www-data * .htaccess

  #  php72w-gd - already installed?
  # && apt-get install -y libpng-dev 
  #  php72w-mbstring -
  #  php72w-mysqlnd -
  #  php72w-xml -
  #  php72w-common - already installed?
  #  php72w-tidy - already installed?
  # && apt-get install -y libtidy-dev 
  #  php72w-cli - 
  #  php72w-intl