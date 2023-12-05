run:
	cd .. && docker-compose up -d --build
	chmod 777 public/img
	cd .. && docker-compose exec web php -r "require 'public/db.php'; createDb();"

initData:
	cd .. && docker-compose exec web php -r "require 'public/db.php'; createDataFixtures();"

stop:
	cd .. && docker-compose down

initP:
	cd .. && touch Dockerfile
	echo 'FROM php:8.2-apache' >> ../Dockerfile \
    && echo 'RUN docker-php-ext-install pdo pdo_mysql' >> ../Dockerfile \
    && echo 'RUN chmod -R 777 /var/www' >> ../Dockerfile \
    && echo 'WORKDIR /var/www/html' >> ../Dockerfile \
    && echo 'RUN apt-get update \ && apt-get install -y unzip \ && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer' >> ../Dockerfile \
    && echo 'RUN cd /var/www/html \ && composer require "vlucas/phpdotenv:^5.0" "twig/twig:^3.0" "fakerphp/faker:^1.9"' >> ../Dockerfile \
    && echo 'RUN pecl install xdebug \ && apt update \ && apt install libzip-dev -y \ && docker-php-ext-enable xdebug \ && a2enmod rewrite \ && docker-php-ext-install zip \ && service apache2 restart' >> ../Dockerfile \
    && echo 'ENV APACHE_DOCUMENT_ROOT=/var/www/html/public' >> ../Dockerfile \
    && echo 'RUN sed -ri -e '\''s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g'\'' /etc/apache2/sites-available/*.conf' >> ../Dockerfile \
    && echo 'RUN sed -ri -e '\''s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g'\'' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf' >> ../Dockerfile \
    && echo 'COPY . /var/www/html/' >> ../Dockerfile

	cd .. && touch docker-compose.yml
	echo 'version: '\''3'\''' >> ../docker-compose.yml \
    && echo 'services:' >> ../docker-compose.yml \
    && echo '  mysql:' >> ../docker-compose.yml \
    && echo '    image: mysql:latest' >> ../docker-compose.yml \
    && echo '    environment:' >> ../docker-compose.yml \
    && echo '      MYSQL_ROOT_PASSWORD: my-secret-pw' >> ../docker-compose.yml \
    && echo '      MYSQL_DATABASE: prendsTaGoDb' >> ../docker-compose.yml \
    && echo '      MYSQL_USER: PTG_user' >> ../docker-compose.yml \
    && echo '      MYSQL_PASSWORD: PTG_password' >> ../docker-compose.yml \
    && echo '    volumes:' >> ../docker-compose.yml \
    && echo '      - db_data:/var/lib/mysql' >> ../docker-compose.yml \
    && echo '    ports:' >> ../docker-compose.yml \
    && echo '      - "3306:3306"' >> ../docker-compose.yml \
    && echo '  phpmyadmin:' >> ../docker-compose.yml \
    && echo '    image: phpmyadmin/phpmyadmin:latest' >> ../docker-compose.yml \
    && echo '    container_name: phpmyadmin_container' >> ../docker-compose.yml \
    && echo '    environment:' >> ../docker-compose.yml \
    && echo '      PMA_HOST: mysql' >> ../docker-compose.yml \
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
	echo 'DB_SERVERNAME= mysql' >> .env \
	&& echo 'DB_USERNAME=PTG_user' >> .env \
	&& echo 'DB_PASSWORD=PTG_password' >> .env \
	&& echo 'DB_NAME=prendsTaGoDb' >> .env \

	touch composer.json \
	&& echo '{' >> composer.json \
    && echo '	"require": {' >> composer.json \
    && echo '    	"vlucas/phpdotenv": "^5.0",' >> composer.json \
    && echo '    	"twig/twig": "^3.0",' >> composer.json \
    && echo '    	"fakerphp/faker": "^1.9"' >> composer.json \
    && echo '	},' >> composer.json \
    && echo '	"autoload": {' >> composer.json \
    && echo '    	"psr-4": {' >> composer.json \
    && echo '        	"Config\\\": "app/Config/",' >> composer.json \
    && echo '        	"Model\\\": "app/Model/",' >> composer.json \
    && echo '        	"Controller\\\": "app/Controller/",' >> composer.json \
    && echo '        	"View\\\": "app/View/",' >> composer.json \
    && echo '        	"Entity\\\": "app/Entity/"' >> composer.json \
    && echo '    	}' >> composer.json \
    && echo '	}' >> composer.json \
	&& echo '}' >> composer.json \
	&& composer install
