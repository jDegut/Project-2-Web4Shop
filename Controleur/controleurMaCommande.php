<?php

// Controleur de MaCommande

require_once 'Modele/maCommande.php';
require_once 'Modele/panier.php';
require_once 'Vue/Vue.php';

class ControleurMaCommande{
    private $maCommande;
    private $panier;

    public function __construct(){
        $this->maCommande = new MaCommande();
        $this->panier = new Panier();
    }

    //Affiche la liste de tous les produits du site
  
    public function maCommande($idCommande){
        $info=$this->maCommande->getInfoCommande($idCommande);
        $produits=$this->panier->getProductsOrder($idCommande);
        $this->maCommande->creerFacture($idCommande);
        $vue = new Vue("MaCommande");
        $vue->generer(array('info'=>$info,'produits'=>$produits));
    }
  
}
