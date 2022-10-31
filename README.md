# Basket-fit

### Application web de gestion de salle de sport pour une grande marque possèdant plusieurs franchises. Elle permet de gérer les droits accès aux permissions accordées à ses structures selon le contrat qui lie la marque aux franchises à destination de ses équipes.

Cliquer ici pour découvrir l'application web [Basket-fit](https://basket-fit.herokuapp.com/login) !

 ![logo_basket-fit-1](https://user-images.githubusercontent.com/82384109/199078025-4ee6d2aa-3c78-404d-8c1a-5aa72ec4e4c6.png)
 

Un projet réaliser pour mon évaluation en cours de formation de chez Studi pour la session d'examen de décembre 2022.

## Application réaliser en Symfony 6.1.5   

## Installation en local

Cloner le dépôt Github puis déposer le dans le dossier de votre serveur local dans le fichier htdocs ou www 

Activer le serveur apache ainsi que mysql sur votre panel de server ( wamp, xampp ou mamp ).

Penser à bien modifier vos Variables d'environnement avec vos informations de connexion dans le fichier .env et à le renommer en .env.local.php pour qu'il ne soit pas divulger sur github. 

Pour installer les dépendances necessaire à symfony, effectuer la commande :
```bash
  composer install
```
Ensuite, vous pouvez lancer la commande suivante pour démarrer le serveur local :
```bash
  Symfony server:start
```
Ouvrer votre navigateur sur la page 
```bash 
http:/localhost:8000/
```

## Documentation

Pour plus d'information n'hesitez pas à consulter la documentation officiel de Symfony.

[Documentation officiel de Symfony](https://symfony.com/doc/current/index.html)


## Deploiement effectuer sur heroku

Créer un compte sur Heroku. 
Cloner le projet puis suiver les instructions du bundle créer par une ancienne élève de mon école.

https://github.com/Nathalie-Verdavoir/deploy-heroku

 Cela simplifie le déployement et installe une base de données à notre compte heroku.
 Il ne reste plus qu'à paramétrer les variables d'environnements et la base de données avec les informations d'Heroku.

## Technologie Utiliser :

**Client:** Twig, Bootstrap, Javascript 

**Server:** Symfony 6.1.5, PHP 8.1, ORM Doctrine
