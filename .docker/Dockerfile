# https://hub.docker.com/_/php
FROM php:8.2-apache

USER root

WORKDIR /var/www/html

RUN apt-get update -y && apt-get install -y \
        curl \
# to install bas composer packages \
        git \
# required for ext-intl
        libicu-dev \
# required for php-gd
        libpng-dev \
# required for ext-zip
        libzip-dev \
# required for ext-sodium
        libsodium-dev \
# required for ext-soap
        libxml2-dev \
        unzip \
        zip \
        wget \
        nano

RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl bcmath gd pdo_mysql mysqli zip sodium \
    && docker-php-ext-enable pdo_mysql mysqli gd zip

RUN pecl install xdebug-3.3.0alpha2 \
    && docker-php-ext-enable xdebug

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

# Install UglifyJS and Sass globally
RUN npm install -g uglify-js sass

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN a2enmod rewrite headers

RUN chown -R www-data:www-data /var/www/html \
  && a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN service apache2 restart
