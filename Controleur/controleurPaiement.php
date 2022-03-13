<?php

// Controleur de Paiement

require_once 'Modele/paiement.php';
require_once 'Vue/Vue.php';

class ControleurPaiement{
    private $paiement;

    public function __construct(){
      $this->paiement = new Paiement();  
    }

    // Affiche formulaire pour rentrer une nouvelle adresse ou utiliser celle enregistrée
  
    public function paiement(){
        $vue=new Vue('Paiement');
        $vue->generer(array(NULL));
    }
  
    // Controleur des fonctions du modele
  
    public function ctrlPaid($type,$idCommande) {
        return $this->paiement->paid($type,$idCommande);
    }
}