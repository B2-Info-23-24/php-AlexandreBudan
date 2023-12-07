
# PrendsTaGo

PrendsTaGo est un projet de deuxieme année à Ynov Lyon filière informatique, c'est une application web pouvant etre utilisé comme site de location de voiture. Ce projet est avant tout axé sur le Back-End ainsi le Front est voué à etre modifié si le projet est réutilisé.


## Installation classique

Dans un premier temps, il faut clone le repository du projet dans le chemin d'acces que vous souhaitez: 

```bash
git clone https://github.com/B2-Info-23-24/php-AlexandreBudan.git
```

## Lancement

Installez [__DockerDesktop__](https://www.docker.com/products/docker-desktop/).

Une fois cela fait, ouvrez __DockerDesktop__.  
Initialisez votre projet précedemment installé en allant dans le dossier "__src__" puis en executant la commande:

```bash
make initP
```

---

Puis lancez votre projet en executant la commande:

```bash
make run
```
Si jamais dans des cas très rare la commande "make run" ne marche pas du premier coup, relancez la une deuxieme fois

Si vous souhaitez generer des Fakes Datas, executez la commande:

```bash
make initData
```

## Help

Si jamais vous n'avez pas installé la bibliotèque de make, voici le lien vers la page de la bibliotèque:

Installez [__Make__](https://gnuwin32.sourceforge.net/packages/make.htm)

[![Review Assignment Due Date](https://classroom.github.com/assets/deadline-readme-button-24ddc0f5d75046c5622901739e7c5dd533143b0c8e959d652212380cedb1ea36.svg)](https://classroom.github.com/a/YbKxHPdJ)
