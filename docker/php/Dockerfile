FROM php:7.4-fpm

RUN apt update
RUN apt install -y git unzip
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir /usr/bin --filename composer
RUN php -r "unlink('composer-setup.php');"

COPY conf.d/memory.ini $PHP_INI_DIR/conf.d/memory.ini
COPY conf.d/xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini

WORKDIR /app
USER 1000:1000
