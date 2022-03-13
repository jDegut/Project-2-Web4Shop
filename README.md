# Web 4 shop

Projet réalisé par Julian DEGUT et Clara BEAL dans le cadre du Projet S5 de ISI WEB à Polytech Lyon

## Organisation

Répartition du travail : Frontend -> Julian | Backend -> Clara | Finitions Frontend+Backend -> Julian+Clara

Plus de détail :

** Frontend ** => CSS Bootstrap + CSS personnalisé + Structure HTML des Vues

** Backend ** => Vues/Modèles/Controleurs + Routeur + Session

** Finitions ** => Facture + Panier temporaire + Affichage d'erreur + Menus (javascript)

## Difficultés rencontrées et solutions

- Passage de l'architecture MVC simple à l'architecture MVC orientée objet
Etant donné qu'il était impossible de faire des tests durant le passage à une architecture orientée objet, une fois l'implémentation des classes fini, il était difficile de savoir quand est-ce que nous avions fait une erreur.

- Problème pour remplir delivery_add_id dans orders car il n'y avait pas de lien entre les tables orders et delivery_addresses
Afin de relier ces tables nous avons inséré une colonne order_id dans delivery_addresses ce qui nous a ensuite permis de pouvoir faire le lien entre ces deux tables

- Problème affichage erreur : div s'affichant en bas de la page => Pas de solution...

- Panier temporaire infaisable tant qu'il n'y avait pas de Customer_id => résolu avec les variables de session (création d'un customer temporaire lors d'une création de session)

- Implémentation de tableaux de données de la BD dans la facture => résolu en faisant le lien entre les structures de factureGen et MVC

## Nouveautés ajoutées à la BD

- Colonne Order_id dans delivery_add pour pouvoir lier cette table avec la table orders

- Ajout d'une table facture afin d'en stocker toutes les infos de chaque facture

## Architecture du site

http:/localhost/isiweb4shop/index.php

http:/localhost/phpmyadmin => Importer la BD présente dans le dossier BD

** VUES ** (Affichage des données)

- vue : fihier générateur de vues

- VueAccueil : affichage de tous les produits avec nom et prix

- VueCaracteristiques : affichage d'un produit avec toutes ses caractéristiques : nom, catégorie, description, prix ainsi que les avis des clients

- VueCategorie : affichage des produits d'une catégorie selectionnée avec nom et prix

- VueInscription : affichage du formulaire d'inscription

- VueConnexion : affichage du formulaire de connexion

- VuePanier : visualisation du panier du client et possibilité de passer la commande

- VueMonCompte : possible de modifier son mot de passe, voir ses informations et ses commandes

- VueAdresse : permet à l'utilisateur de rentrer une nouvelle adresse ou d'utiliser celle de son compte

- VuePaiement : permet à l'utilisateur de choisir son moyen de paiement chèque ou paypal

- VueMaCommande : récapitulatif de la commande passée (produits, mode de paiement) et accès à la facture

** Modeles ** (Liaison avec la BD)

- modele : fichier créant le lien avec la BD

- adresse

- categorie

- connexion

- inscription

- maCommande

- monCompte

- paiement

- panier

- produit

** Controleurs ** (Liaison Affichage-Requetes utilisés par le routeur)

- routeur : Fichier vérifiant les requêtes et éxécutant les fonctions liés

- controleurAccueil

- controleurAdresse

- controleurCaracteristiques

- controleurCategorie

- controleurConnexion

- controleurInscription

- controleurMaCommande

- controleurMonCompte

- controleurPaiement

- controleurPanier

## Système implémentés (avec succès)

- Connexion/Inscription

- Panier d'utilisateur connecté/visiteur + transfert de panier visiteur à panier connecté (si panier connecté vide)

- Vider la totalité du panier si besoin

- Choix entre adresse enregistrée et nouvelle (pour utilisateurs connectés)

- Génération de factures à l'affichage de la commande effectuée

- Pannel admin pour les utilisateurs de la table admin en restreignant le panier à ceux-ci

## Contenu nécessaire au site

- factureGen : fichiers nécessaire à la génération des factures (polices et module FPDF)

- Images/Scripts/Styles