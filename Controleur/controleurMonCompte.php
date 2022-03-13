<?php

// Controleur de MonCompte

require_once 'Modele/monCompte.php';
require_once 'Modele/adresse.php';
require_once 'Vue/Vue.php';

class ControleurMonCompte{
    private $monCompte;
    private $adresse;
  
    public function __construct(){
        $this->monCompte = new MonCompte();
        $this->adresse = new Adresse();
        $this->connexion = new Connexion();
    }

    //Affiche la liste de tous les produits du site
  
    public function monCompte($idClient=NULL){
        $info = $this->monCompte->getCompteInfo($idClient);
        $commandes = $this->monCompte->getCommandes($idClient);
        $vue = new Vue("MonCompte");
        $vue->generer(array('info'=>$info,'commandes'=>$commandes));
    }
  
    // Controleurs de fonctions du modele
  
    public function ctrlChangePass($pseudo,$hashMdp){
        return $this->monCompte->changePass($pseudo,$hashMdp);
    }
  
    public function ctrlCheckMdp($pseudo,$oldHashMdp){
        return $this->connexion->checkUser($pseudo,$oldHashMdp);
    }
  
    public function ctrlExpeCommande($idCommande,) {
        $this->adresse->updateStatusOrder($idCommande,10);
    }
  
    public function ctrlChequeCommande($idCommande) {
        $this->adresse->updateStatusOrder($idCommande,2);
    }
  
}
