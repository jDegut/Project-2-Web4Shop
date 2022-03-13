<?php

// Controleur de l'Inscription

require_once 'Modele/inscription.php';
require_once 'Vue/Vue.php';

class ControleurInscription {
    private $inscription;

    public function __construct(){
        $this->inscription = new Inscription();
    }

    // Affiche le formulaire d'inscription
  
    public function inscription(){
        $vue=new Vue('Inscription');
        $vue->generer(array(NULL));
    }
  
    // Controleurs des fonctions du modele

    public function ctrlCheckAvaibilityPseudo($pseudo){
       return $this->inscription->checkAvaibilityPseudo($pseudo);
    }

    public function ctrlCheckAvaibilityEmail($email){
        return $this->inscription->checkAvaibilityEmail($email);
     }

    public function ctrlRegister($prenom,$nom,$add1,$add2,$ville,$cp,$numTel,$email,$pseudo,$hashMdp){
        $this->inscription->register($prenom,$nom,$add1,$add2,$ville,$cp,$numTel,$email,$pseudo,$hashMdp);
    }
  
    public function ctrlRegisterSession(){
        return $this->inscription->registerSession();
    }
}
