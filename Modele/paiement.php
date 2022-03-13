<?php 

// Modele Paiement

require_once 'Modele/Modele.php';

class Paiement extends Modele{

    // Fonction déclarant la commande comme payée
  
    public function paid($type,$idCommande) {
      
        // En attente de paiement status = 3 ; payée status = 2
      
        if($type == "cheque"){ $status=3;} else { $status=2;} 
      
        $sql='UPDATE orders SET status=? WHERE id=?';
        $this->executerRequete($sql,array($status,$idCommande));
        $sql='UPDATE orders SET payment_type=? WHERE id=?';
        $this->executerRequete($sql,array($type,$idCommande));
    }
  
}
