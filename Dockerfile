FROM php:8.0-apache

# Install additional PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer Twig
RUN mkdir -p /var/www/html/vendor/twig && \
    curl -L https://github.com/twigphp/Twig/archive/v2.14.8.tar.gz | tar xvz -C /var/www/html/vendor/twig --strip-components=1

# Copier les fichiers de votre application dans le conteneur
COPY . /var/www/html/



