
# PrendsTaGo

PrendsTaGo est un projet de deuxieme année à Ynov Lyon filière informatique, c'est une application web pouvant etre utilisé comme site de location de voiture. Ce projet est avant tout axé sur le Back-End ainsi le Front est voué à etre modifié si le projet est réutilisé.


## Installation classique

Dans un premier temps, il faut clone le repository du projet dans le chemin d'acces que vous souhaitez: 

```bash
git clone https://github.com/B2-Info-23-24/php-AlexandreBudan.git
```

## Récupération du fichier src

### Création des différents fichier d'initialisation

Si jamais vous souhaitez uniquement récupérer le dossier src, il vous faudra aussi ajouter un fichier '__Dockerfile__' a la source de votre dossier comme cela:

```bash
touch Dockerfile
```

Puis y inserer le code suivant:

```Dockerfile
FROM php:8.2-apache

# Install additional PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

RUN chmod -R 777 /var/www

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer Composer
RUN apt-get update && \
    apt-get install -y unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer les dépendances avec Composer
RUN cd /var/www/html && \
    composer require "vlucas/phpdotenv:^5.0" "twig/twig:^3.0" "fakerphp/faker:^1.9"

RUN pecl install xdebug \
    && apt update \
    && apt install libzip-dev -y \
    && docker-php-ext-enable xdebug \
    && a2enmod rewrite \
    && docker-php-ext-install zip \
    && service apache2 restart

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copier les fichiers de l'application dans le conteneur
COPY . /var/www/html/
```

---

Il vous faudra aussi un fichier '__docker-compose.yml__' a la source de votre dossier comme cela:

```yml
version: '3'

services:
  web:
    build:
      context: .
      dockerfile: Dockerfile
    ports:
      - "8080:80" # Expose port 8080 on WSL to port 80 in the container
    volumes:
      - ./src:/var/www/html

  mysql:
    image: mysql:latest
    environment:
      MYSQL_ROOT_PASSWORD: my-secret-pw
      MYSQL_DATABASE: prendsTaGoDb
      MYSQL_USER: PTG_user
      MYSQL_PASSWORD: PTG_password
    volumes:
      - db_data:/var/lib/mysql
    ports:
      - "3306:3306" # Expose port 3306 on the host to port 3306 in the container

volumes:
  db_data:

```

### Création d'un fichier Makefile pour simplifier le lancement

Si vous souhaitez simplifier votre lancement d'application, vous pouvez créer un fichier '__Makefile__' à la source de votre projet comme cela:

```bash
touch Makefile
```

Puis y inserer le code suivant:

```Makefile
run:
	docker-compose up -d --build

stop:
	docker-compose down

initP:
	cd src/ && composer require "vlucas/phpdotenv:^5.0" "twig/twig:^3.0" "fakerphp/faker:^1.9"

getIp:
	ip -4 addr show eth0 | grep -oP '(?<=inet\s)\d+(\.\d+){3}'
```

Si jamais vous ne souhaitez pas utiliser Makefile, vous serez amener à faire un plus grand nombres de commandes et à revenir à ce point de la documentation pour chaque lancement.
## Lancement

Installez [__DockerDesktop__](https://www.docker.com/products/docker-desktop/).  

Installez [__wampServer__](https://www.wampserver.com/) pour la gestion de la bdd.   

Créez un fichier '__.env__' dans votre dossier '__src__' puis remplissez le avec ces informations:

```bash
DB_SERVERNAME= #Adresse Ip de votre wsl ou localhost si vous etes sur windows
DB_USERNAME=PTG_user
DB_PASSWORD=PTG_password
DB_NAME=prendsTaGoDb
```

Pour récuperer l'adresse Ip de votre wsl, exécuté la commande:

```bash
make getIp
```
(Voir ci-dessus dans le dossier Makefile, les commandes a executé si jamais vous n'avez pas créé de __Makefile__)
  
Une fois cela fait, ouvrez __DockerDesktop__.  
Initialisez votre projet précedemment installé en executant la commande:

```bash
make initP
```
(Voir ci-dessus dans le dossier Makefile, les commandes a executé si jamais vous n'avez pas créé de __Makefile__)

---

Puis lancez votre projet en executant la commande:

```bash
make run
```
(Voir ci-dessus dans le dossier Makefile, les commandes a executé si jamais vous n'avez pas créé de __Makefile__)

Une fois cela fait, ouvrez __wampServer__.

[![Review Assignment Due Date](https://classroom.github.com/assets/deadline-readme-button-24ddc0f5d75046c5622901739e7c5dd533143b0c8e959d652212380cedb1ea36.svg)](https://classroom.github.com/a/YbKxHPdJ)