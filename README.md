# Symfony projet

## Versions

**Php 8.1**

**Symfony 6.2**

**VueJS 3.2**

## Installation des packages : 

```shell
composer install
```

```shell
npm install
```

## Commandes à exécuter : 

Création de la base de donnée : 

```
php bin/console doctrine:database:create
```

Création des tables dans la BDD

```
php bin/console doctrine:migrations:migrate
```

Enregistrement de fausses données en BDD: 

```
php bin/console doctrine:fixtures:load
```

Lancer le serveur vue: 

```
npm run watch
```

Lancer le serveur symfony : 

```
symfony server:start
```

## Fonctionnement : 

Création d'un compte admin en enregistrant puis en changeant sont rôle en "ROLE_ADMIN" en BDD

## Commande

Attribution des salles aux ateliers : 

```
php bin/console app:assign-workshop-to-university-room
```

hachage des données utilisateurs  :

```
php bin/console app:hash-students-data
```

##  Formulaire de contact en VUE : 

L'enregistrement des données du formulaire de contact ce fais dans la table Contact

