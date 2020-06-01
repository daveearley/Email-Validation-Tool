FROM php:7.4-fpm

RUN curl https://getcomposer.org/installer > composer-setup.php \
 && php composer-setup.php \
 && mv composer.phar /usr/local/bin/composer \
 && rm composer-setup.php

# Install git
RUN apt-get update \
 && apt-get -y install git \
 && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR /web
ADD . /web

RUN /usr/local/bin/composer install --prefer-dist --no-dev
