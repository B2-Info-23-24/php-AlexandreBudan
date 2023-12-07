run:
	docker-compose --env-file .env up -d && chmod 777 public/img; \
    echo 'Waiting for mysql to be ready...' && sleep 25; \
	docker-compose exec web php -r "require 'public/db.php'; createDb();"

initData:
	docker-compose exec web php -r "require 'public/db.php'; createDataFixtures();"

stop:
	docker-compose down

initP:
	cd .. && touch Dockerfile
	echo 'FROM php:8.1-apache' >> ../Dockerfile \
    && echo 'RUN docker-php-ext-install pdo pdo_mysql' >> ../Dockerfile \
    && echo 'RUN chmod -R 777 /var/www' >> ../Dockerfile \
    && echo 'WORKDIR /var/www/html' >> ../Dockerfile \
    && echo 'RUN apt-get update && \' >> ../Dockerfile \
    && echo '    apt-get install -y unzip && \' >> ../Dockerfile \
    && echo '    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer' >> ../Dockerfile \
    && echo 'RUN cd /var/www/html && \' >> ../Dockerfile \
    && echo '    composer require "vlucas/phpdotenv:^5.0" "twig/twig:^3.0" "fakerphp/faker:^1.9"' >> ../Dockerfile \
    && echo 'RUN pecl install xdebug && \' >> ../Dockerfile \
    && echo '    apt update && \' >> ../Dockerfile \
    && echo '    apt install libzip-dev -y && \' >> ../Dockerfile \
    && echo '    docker-php-ext-enable xdebug && \' >> ../Dockerfile \
    && echo '    a2enmod rewrite && \' >> ../Dockerfile \
    && echo '    docker-php-ext-install zip && \' >> ../Dockerfile \
    && echo '    service apache2 restart' >> ../Dockerfile \
    && echo 'ENV APACHE_DOCUMENT_ROOT=/var/www/html/public' >> ../Dockerfile \
    && echo 'RUN sed -ri -e '\''s!/var/www/html!$${APACHE_DOCUMENT_ROOT}!g'\'' /etc/apache2/sites-available/*.conf' >> ../Dockerfile \
    && echo 'RUN sed -ri -e '\''s!/var/www/html!$${APACHE_DOCUMENT_ROOT}!g'\'' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf' >> ../Dockerfile \
    && echo 'COPY . /var/www/html/' >> ../Dockerfile

	cd .. && touch docker-compose.yml
	echo 'version: '\''3'\''' >> ../docker-compose.yml \
    && echo 'services:' >> ../docker-compose.yml \
    && echo '  mysql:' >> ../docker-compose.yml \
    && echo '    image: mysql:latest' >> ../docker-compose.yml \
    && echo '    environment:' >> ../docker-compose.yml \
    && echo '      MYSQL_ROOT_PASSWORD: $${DB_ROOT_PASSWORD}' >> ../docker-compose.yml \
    && echo '      MYSQL_DATABASE: $${DB_NAME}' >> ../docker-compose.yml \
    && echo '      MYSQL_USER: $${DB_USERNAME}' >> ../docker-compose.yml \
    && echo '      MYSQL_PASSWORD: $${DB_PASSWORD}' >> ../docker-compose.yml \
    && echo '    volumes:' >> ../docker-compose.yml \
    && echo '      - db_data:/var/lib/mysql' >> ../docker-compose.yml \
    && echo '    ports:' >> ../docker-compose.yml \
    && echo '      - "3306:3306"' >> ../docker-compose.yml \
    && echo '  phpmyadmin:' >> ../docker-compose.yml \
    && echo '    image: phpmyadmin/phpmyadmin:latest' >> ../docker-compose.yml \
    && echo '    container_name: phpmyadmin_container' >> ../docker-compose.yml \
    && echo '    environment:' >> ../docker-compose.yml \
    && echo '      PMA_HOST: $${DB_SERVERNAME}' >> ../docker-compose.yml \
    && echo '      PMA_PORT: 3306' >> ../docker-compose.yml \
    && echo '      MYSQL_ROOT_PASSWORD: root' >> ../docker-compose.yml \
    && echo '    ports:' >> ../docker-compose.yml \
    && echo '      - "8081:80"' >> ../docker-compose.yml \
    && echo '    depends_on:' >> ../docker-compose.yml \
    && echo '      - mysql' >> ../docker-compose.yml \
    && echo '  web:' >> ../docker-compose.yml \
    && echo '    build:' >> ../docker-compose.yml \
    && echo '      context: .' >> ../docker-compose.yml \
    && echo '      dockerfile: Dockerfile' >> ../docker-compose.yml \
    && echo '    ports:' >> ../docker-compose.yml \
    && echo '      - "8080:80"' >> ../docker-compose.yml \
    && echo '    volumes:' >> ../docker-compose.yml \
    && echo '      - ./src:/var/www/html' >> ../docker-compose.yml \
    && echo '    depends_on:' >> ../docker-compose.yml \
    && echo '      - phpmyadmin' >> ../docker-compose.yml \
    && echo '      - mysql' >> ../docker-compose.yml \
    && echo 'volumes:' >> ../docker-compose.yml \
    && echo '  db_data:' >> ../docker-compose.yml

	touch .env
	echo 'DB_SERVERNAME=mysql' >> .env \
    && echo 'DB_ROOT_PASSWORD=PTG_root_password' >> .env \
	&& echo 'DB_USERNAME=PTG_user' >> .env \
	&& echo 'DB_PASSWORD=PTG_password' >> .env \
	&& echo 'DB_NAME=prendsTaGoDb' >> .env
	composer install