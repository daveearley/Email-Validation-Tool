FROM php:7.0-fpm-alpine

RUN curl https://getcomposer.org/installer > composer-setup.php && php composer-setup.php && mv composer.phar /usr/local/bin/composer && rm composer-setup.php
RUN apk update && apk upgrade && \
    apk add --no-cache bash git openssh
WORKDIR /web
ADD . /web

RUN /usr/local/bin/composer install --prefer-dist --no-dev
