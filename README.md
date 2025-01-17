# Projet « Cyberfolio »

## Compte administrateur

- URL du *back-office* : `localhost:8000`
- Identifiant : `arthur.mounissens@gmail.com`
- Mot de passe : `1234`

## État d'avancement

Fonctionnalité principal terminées. Il pourrait il y avoir plus d'ajustement

## Difficultés rencontrées et solutions

1. Security bundle: Il faut mettre la restriction ROLE_USER à la racine après avoir définit les autres restrictions
2. CSS: Le css change quand on change de page et qu'on actualise (en plus de ne pas être très joli)

## Bilan des acquis

- Système de login
- fonctionnement de twig
- Utilisation de l'ORM Doctrine
- Révision du modèle MVC

## Remarques complémentaires

il faut ajouter le .env.local et remplir le login et MDP correspondant dans `DATABASE_URL`

Il manque quelques fonctionnalités clés ou ajustements au projet :
- N'importe qui peut modifier les données du portfolio
- Le style n'est pas très développé (je déteste le css)
- On ne peut pas directement modifier un projet, il faut le supprimer et le rajouter
