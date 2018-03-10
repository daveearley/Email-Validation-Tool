FROM php:7.1-fpm

RUN curl https://getcomposer.org/installer > composer-setup.php && php composer-setup.php && mv composer.phar /usr/local/bin/composer && rm composer-setup.php
WORKDIR /web
ADD . /web

RUN /usr/local/bin/composer install --prefer-dist --no-dev
