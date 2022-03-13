<?php

// Modele Categorie

require_once 'Modele/Modele.php';

class Categorie extends Modele{
  
    // Renvoie la catégorie du produit (utilisée pour la présentation d'un produit)
  
    public function getCategorie($idProduit){
        $sql = 'SELECT C.name, C.id FROM products P JOIN categories C ON P.cat_id=C.id WHERE P.id=?';
        $categorie = $this->executerRequete($sql,array($idProduit));
        return $categorie->fetch();
    }

    // Renvoie les catégories qui existent (utilisée pour le menu des catégories)
  
    public function getCategories(){
        $sql = 'SELECT * FROM categories';
        $categories = $this->executerRequete($sql);
        return $categories->fetchAll();
    }

    // Renvoie le nom de la catégorie sélectionnéee (utilisée pour le titre de vueCategorie)
  
    public function getNameCategorie($idCategorie){
        $sql = 'SELECT name FROM categories WHERE id=?';
        $nom = $this->executerRequete($sql,array($idCategorie));
        return $nom->fetch(); 
    }
}
