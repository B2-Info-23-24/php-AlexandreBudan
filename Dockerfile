FROM php:8.1-apache
RUN docker-php-ext-install pdo pdo_mysql
RUN chmod -R 777 /var/www
WORKDIR /var/www/html
RUN apt-get update && \
    apt-get install -y unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN cd /var/www/html && \
    composer require "vlucas/phpdotenv:^5.0" "twig/twig:^3.0" "fakerphp/faker:^1.9"
RUN pecl install xdebug && \
    apt update && \
    apt install libzip-dev -y && \
    docker-php-ext-enable xdebug && \
    a2enmod rewrite && \
    docker-php-ext-install zip && \
    service apache2 restart
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
COPY . /var/www/html/
