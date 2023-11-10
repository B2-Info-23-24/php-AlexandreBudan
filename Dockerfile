FROM php:8.0-apache

# Install additional PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copiez le fichier .env dans le conteneur
COPY src/.env /var/www/html/.env

# Installez Composer
RUN apt-get update && \
    apt-get install -y unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiez composer.json et composer.lock pour installer les dépendances
COPY src/composer.json /var/www/html/composer.json
COPY src/composer.lock /var/www/html/composer.lock

# Installez les dépendances avec Composer
RUN cd /var/www/html && \
    composer require "vlucas/phpdotenv:^5.0" "twig/twig:^3.0"

# Copier les fichiers de votre application dans le conteneur
COPY . /var/www/html/