<?php

// Controleur de Panier

require_once 'Modele/panier.php';
require_once 'Vue/Vue.php';

class ControleurPanier {
    private $panier;

    public function __construct(){
        $this->panier = new Panier();
    }

    // Affiche le panier du client vide
  
    public function panier(){
        $vue=new Vue('Panier');
        $vue->generer(array(NULL));
    }
  
    // Affiche le panier du client aves des produits
  
    public function panierCommande($idClient,$idCommande){
        $produits=$this->panier->getProductsOrder($idCommande);
        $commande=$this->panier->checkOrder($idClient);
        $totalPrice=$this->panier->getTotalPrice($idCommande);
        $vue=new Vue('Panier');
        $vue->generer(array('produits'=>$produits,'commande'=>$commande,'totalPrice'=>$totalPrice));
    }
  
    // Controleurs des fonctions du modele
  
    public function ctrlViderPanier($idCommande){
      return $this->panier->viderPanier($idCommande);
    }

    public function ctrlSetTotalOrder($idCommande){
        $this->panier->setTotalOrder($idCommande);
    }
  
    public function ctrlTransfertPanier($idClient,$idCommande,$pseudo) {
        return $this->panier->transfertPanier($idClient,$idCommande,$pseudo);
    }
  
    public function ctrlSupprCustomer($idClient) {
        return $this->panier->supprCustomer($idClient);
    }
}
