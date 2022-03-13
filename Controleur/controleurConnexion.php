<?php

// Controleur de Connexion

require_once 'Modele/connexion.php';
require_once 'Vue/Vue.php';

class ControleurConnexion{
    private $connexion;

    public function __construct(){
        $this->connexion = new Connexion();
    }

    // Affiche le formulaire de connexion
  
    public function connexion(){
        $vue=new Vue('Connexion');
        $vue->generer(array(NULL));
    }
  
    // Controleurs des fonctions du modele

    public function ctrlCheckUser($pseudo,$hashMdp){
        return $this->connexion->checkUser($pseudo,$hashMdp);
    }
  
    public function ctrlCheckAdmin($pseudo,$hashMdp){
        return $this->connexion->checkAdmin($pseudo,$hashMdp);
    }
}
