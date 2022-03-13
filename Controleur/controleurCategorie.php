<?php

// Controleur de Categorie

require_once 'Modele/produit.php';
require_once 'Modele/categorie.php';
require_once 'Vue/Vue.php';

class ControleurCategorie {
    private $produits;
    private $categories;
    private $nom;

    public function __construct(){
        $this->produits = new Produit();
        $this->categories = new Categorie();
        $this->nom = new Categorie();
    }

    //Affiche la liste de tous les produits d'une catégorie
  
    public function categorie($idCat){
        $produits = $this->produits->getProdCat($idCat);
        $categories = $this->categories->getCategories();
        $nom = $this->nom->getNameCategorie($idCat);
        $vue = new Vue("Categorie");
        $vue->generer(array('produits' => $produits,'categories' => $categories,'nom' => $nom));
    }
}
