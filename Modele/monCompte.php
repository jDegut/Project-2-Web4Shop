<?php 

// Modele MonCompte

require_once 'Modele/Modele.php';

class MonCompte extends Modele {

    // Fonction changeant le mot de passe du client
  
    public function changePass($pseudo,$hashMdp){
        $sql='UPDATE logins SET password=? WHERE username=?';
        $resultat=$this->executerRequete($sql,array($hashMdp,$pseudo));
    }
  
    // Fonction renvoyant les informations du compte
  
    public function getCompteInfo($idClient) {
        $sql='SELECT C.* FROM customers C JOIN logins L ON C.id=L.customer_id WHERE L.customer_id=?';
        $informations = $this->executerRequete($sql,array($idClient));
        return $informations->fetch();
    }
  
    // Fonction renvoyant toutes les commandes d'un utilisateur
  
    public function getCommandes($idClient=NULL) {
        if($idClient==NULL) {
            $sql='SELECT * FROM orders WHERE (status=2 or status=3)';
            $commandes = $this->executerRequete($sql,NULL);
        } else {
            $sql='SELECT * FROM orders WHERE customer_id=? AND (status=2 OR status=3 OR status=10)';
            $commandes = $this->executerRequete($sql,array($idClient));
        }
        return $commandes->fetchAll();
    }
  
}
