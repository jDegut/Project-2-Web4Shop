<?php 

// Classe Modele structurant le backend

abstract class Modele {

    // Objet PDO d'acces à la BD
  
    private $bdd;

    // Exécute une requête SQL éventuellement paramétrée
  
    protected function executerRequete($sql, $params = null){
        if($params == null){
            $resultat = $this->getBDD()->query($sql); // exécution directe
        }
        else{
            $resultat = $this->getBDD()->prepare($sql); // requête préparée
            $resultat->execute($params);
        }
        return $resultat;
    }

    // Renvoie un objet de connexion à la BD en initialisant la connexion au besoin
  
    private function getBDD(){
        if($this->bdd == null){
            $this->bdd=new PDO('mysql:host=db5006919776.hosting-data.io;dbname=dbs5712877;charset=utf8','dbu2781451','Web4Shop2022');
            array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        return $this->bdd;
    }
  
    // Renvoie le dernier identifiant inseré dans la bd  
  
    public function last_insert_id() {
      return $this->getBDD()->lastInsertId();
    }
}
