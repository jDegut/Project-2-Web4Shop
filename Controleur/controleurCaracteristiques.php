<?php

// Controleur de Caracteristiques

require_once 'Modele/produit.php';
require_once 'Modele/categorie.php';
require_once 'Modele/panier.php';
require_once 'Vue/Vue.php';

class ControleurCaracteristiques {
    private $caracteristiques;
    private $categorie;
    private $panier;

    public function __construct(){
        $this->caracteristiques = new Produit();
        $this->categorie = new Categorie();
        $this->panier = new Panier();
    }

    //Affiche les détails sur un produit
  
    public function caracteristiques($idProduit,$msgErreur=""){
        $caracteristiques = $this->caracteristiques->getCaracteristiques($idProduit);
        $categorie = $this->categorie->getCategorie($idProduit);
        $reviews = $this->caracteristiques->getReviews($idProduit);
        $vue = new Vue("Caracteristiques");
        $vue->generer(array('caracteristiques' => $caracteristiques, 'categorie' => $categorie, 'reviews' => $reviews, 'msgErreur'=>$msgErreur));
    }
  
    // Controleurs des fonctions du modele

    public function ctrlCheckOrder($idClient){
        return $this->panier->checkOrder($idClient);
    }

    public function ctrlGetIdOrder($idClient,$status){
        return $this->panier->getIdOrder($idClient,$status);
    }

    public function ctrlCreateOrder($idClient,$session,$logged){
        $this->panier->createOrder($idClient,$session,$logged);
    }

    public function ctrlAddProduct($idCommande,$idProduit,$qteProduit){
        return $this->panier->addProduct($idCommande,$idProduit,$qteProduit);
    }

    public function ctrlGetCustomerId($pseudo){
        return $this->panier->getCustomerId($pseudo);
    }
  
    public function ctrlAjouterAvis($idProduit,$avis) {
        return $this->caracteristiques->ajouterAvis($idProduit,$avis);
    }
}
