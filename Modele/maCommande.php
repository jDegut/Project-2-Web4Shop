<?php 

// Modele MaCommande

require_once 'Modele/Modele.php';

class MaCommande extends Modele {

    // Fonction récupérant les infos d'une commande
  
    public function getInfoCommande($idCommande){
        $sql='SELECT * FROM orders WHERE id=?';
        $infos=$this->executerRequete($sql,array($idCommande));
        return $infos->fetch();
    }
    
    // Fonction qui crée la facture dans la BDD  
  
    public function creerFacture($idCommande){
        // Try et catch pour éviter les erreurs si la facture est déja créée (actualisation de la page)
      
        try{
          $sql='SELECT sum(quantity) FROM orderitems WHERE order_id=?';
          $res=$this->executerRequete($sql,array($idCommande));
          $nb_prod=$res->fetch()['sum(quantity)'];

          $date=date("Y-m-d");

          $sql='SELECT total FROM orders WHERE id=?';
          $res=$this->executerRequete($sql,array($idCommande));
          $price=$res->fetch()['total'];
          $sql='SELECT payment_type FROM orders WHERE id=?';
          $res=$this->executerRequete($sql,array($idCommande));
          $reglement=$res->fetch()['payment_type'];

          $date_echeance=date("Y-m-d",strtotime("+1 month"));

          $sql='INSERT INTO factures VALUES (?,?,?,?,?,?)';
          $this->executerRequete($sql,array($idCommande,$nb_prod,$date,$price,$reglement,$date_echeance));
        } catch(Exception $e) {
        }
    }
  
}
