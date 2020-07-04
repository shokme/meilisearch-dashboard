FROM composer:2 as vendor
WORKDIR /app

COPY database/ /app/database/
COPY composer.json composer.lock /app/
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-dev \
    --no-scripts \
    --prefer-dist

COPY . /app
RUN composer dump-autoload --optimize --classmap-authoritative

FROM node as frontend
WORKDIR /app

COPY package.json webpack.mix.js package-lock.json tailwind.config.js /app/
RUN npm install

COPY resources/ /app/resources/
RUN npm run production

FROM php:7.4-apache

RUN a2enmod rewrite

ADD docker/apache.conf /etc/apache2/sites-available/000-default.conf
ADD docker/php.ini ${PHP_INI_DIR}/conf.d/99-overrides.ini

WORKDIR /app
COPY --from=vendor /app /app
COPY --from=frontend /app/public /app/public
RUN chgrp -R www-data /app/storage /app/bootstrap/cache && chmod -R ug+rwx /app/storage /app/bootstrap/cache

RUN cp .env.example .env

ADD docker/start.sh /
RUN chmod +x /start.sh

RUN touch /app/database/database.sqlite
RUN ["php", "artisan", "key:generate"]
RUN ["php", "artisan", "migrate"]
