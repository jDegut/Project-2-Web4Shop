<?php 

// Classe permettant au template facture d'accéder aux infos de la commande

require_once '../Modele/modele.php';

class Facture extends Modele{
  
    // Fonction renvoyant les infos de la facture créées lors du paiement de la commande
  
    public function getRow($idCommande) {
        $sql = 'select * FROM factures where id=?';
        $res=$this->executerRequete($sql,array($idCommande));
        return $res->fetch();
    }
  
    // Fonction renvoyant les infos du client
  
    public function getRow_client($idCommande) {
        $sql = 'select * from delivery_addresses d join factures f on d.order_id=f.id where order_id=?';
        $res=$this->executerRequete($sql,array($idCommande));
        return $res->fetch();
    }
  
    // Fonction renvoyant les produits de la commande
  
    public function getProducts($idCommande) {
        $sql = 'select * FROM products p join orderitems o on p.id=o.product_id where order_id=?';
        $res=$this->executerRequete($sql,array($idCommande));
        return $res->fetchAll();
    }
  
}
