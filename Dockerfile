FROM php:7.4

RUN apt-get update && apt-get install -y \
    git libzip-dev zip && \
    docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php \
  && chmod +x composer.phar && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www

ADD composer.json composer.lock ./
RUN composer global require hirak/prestissimo
RUN composer install --no-scripts --no-autoloader

ADD . .
RUN chmod +x artisan

RUN composer dump-autoload --optimize

RUN cp .env.example .env

CMD bash -c "php artisan key:generate && php artisan serve --host 0.0.0.0 --port 8000"
