<?php

// Routeur : Lien entre back et front //

// Fichiers requis

require_once 'Controleur/controleurAccueil.php';
require_once 'Controleur/controleurCaracteristiques.php';
require_once 'Controleur/controleurCategorie.php';
require_once 'Controleur/controleurInscription.php';
require_once 'Controleur/controleurConnexion.php';
require_once 'Controleur/controleurPanier.php';
require_once 'Controleur/controleurMonCompte.php';
require_once 'Controleur/controleurAdresse.php';
require_once 'Controleur/controleurPaiement.php';
require_once 'Controleur/controleurMaCommande.php';
require_once 'Vue/vue.php';

class Routeur {
  private $ctrlAccueil;
  private $ctrlCaracteristiques;
  private $ctrlCategorie;
  private $ctrlInscription;
  private $ctrlConnexion;
  private $ctrlPanier;
  private $ctrlMonCompte;
  private $ctrlAdresse;
  private $ctrlPaiement;
  private $ctrlMaCommande;

// Fonction de construction du routeur

  public function __construct(){
    $this->ctrlAccueil = new ControleurAccueil();
    $this->ctrlCaracteristiques = new ControleurCaracteristiques();
    $this->ctrlCategorie = new ControleurCategorie();
    $this->ctrlInscription = new ControleurInscription();
    $this->ctrlConnexion = new ControleurConnexion();
    $this->ctrlPanier = new ControleurPanier();
    $this->ctrlMonCompte = new ControleurMonCompte();
    $this->ctrlAdresse = new ControleurAdresse();
    $this->ctrlPaiement = new ControleurPaiement();
    $this->ctrlMaCommande = new ControleurMaCommande();
  }
  
  //Traite une requête entrante (try/catch pour les erreurs)
  
  public function routerRequete(){
    try {
      
       // Initialisation des variables de session
      
      if(!isset($_SESSION['id'])){
        $_SESSION['id']=session_id();
      }
      if(!isset($_SESSION['idClient'])) {
        $_SESSION['idClient']=$this->ctrlInscription->ctrlRegisterSession();
      }
      if(!isset($_SESSION['logged'])){
        $_SESSION['logged']=false;
      }
      if(!isset($_SESSION['admin'])) {
        $_SESSION['admin']=false;
      }
      
      // Si requete envoyée
      
      if(isset($_GET['action'])){
        
        // Caractéristiques //
        
        if($_GET['action']=='details'){

          $idProduit=intval($this->getParametre($_GET,'idProduit')); //intval renvoie la valeur numerique du parametre ou 0 en cas d'echec
          
          if($idProduit!=0){
            $this->ctrlCaracteristiques->caracteristiques($idProduit);
          }
          else{
            throw new Exception("Identifiant du produit incorrect");
          }
          
          // Ajouter un produit au panier
          
          if(isset($_POST['ajoutPanier'])){
            
            // Si l'utilisateur est connecté

            if($_SESSION['logged']){

              $pseudoClient=$this->getParametre($_SESSION,'pseudo');
              $client=$this->ctrlCaracteristiques->ctrlGetCustomerId($pseudoClient);
              $idClient=$client['customer_id'];
              $qteProduit=intval($this->getParametre($_POST,'qte'));

              if($this->ctrlCaracteristiques->ctrlCheckOrder($idClient)){ //On regarde si l'utilisateur a une commande en cours
                $idCommande=$this->ctrlCaracteristiques->ctrlGetIdOrder($idClient,0);

                //On vérifie qu'il n'y a pas de problème de stock
                if($this->ctrlCaracteristiques->ctrlAddProduct($idCommande,$idProduit,$qteProduit)){
                echo('<script> location.replace("index.php?action=panier"); </script>');
                }
                else{
                  throw new Exception("Produit en rupture de stock/en quantité insuffisante");
                }
              }
              else{
                
                //Si l'utilisateur n'a pas de commande en cours il faut en créer une
                $this->ctrlCaracteristiques->ctrlCreateOrder($idClient,$_SESSION['id'],true);
                $idCommande=$this->ctrlCaracteristiques->ctrlGetIdOrder($idClient,0);

                if($this->ctrlCaracteristiques->ctrlAddProduct($idCommande,$idProduit,$qteProduit)){
                  echo('<script> location.replace("index.php?action=panier"); </script>');
                }
                else{
                  throw new Exception("Produit en rupture de stock/en quantité insuffisante");
                }
              }
              
            // Si l'utilisateur n'est pas connecté
              
            } else {
              
                $idSession=$_SESSION['id'];
                $idClient=$_SESSION['idClient'];
                $qteProduit=$this->getParametre($_POST,'qte');
              
                if($this->ctrlCaracteristiques->ctrlCheckOrder($idClient)){ //On regarde si l'utilisateur a une commande en cours
                  $idCommande=$this->ctrlCaracteristiques->ctrlGetIdOrder($idClient,0);
                  
                  //On vérifie qu'il n'y a pas de problème de stock
                  if($this->ctrlCaracteristiques->ctrlAddProduct($idCommande,$idProduit,$qteProduit)){
                    echo('<script> location.replace("index.php?action=panier"); </script>');
                  } else {
                    throw new Exception("Produit en rupture de stock/en quantité insuffisante");
                  }
                } else{
                  
                  //Si l'utilisateur n'a pas de commande en cours il faut en créer une
                  $this->ctrlCaracteristiques->ctrlCreateOrder($idClient,$_SESSION['id'],false);
                  $idCommande=$this->ctrlCaracteristiques->ctrlGetIdOrder($idClient,0);
                  
                  if($this->ctrlCaracteristiques->ctrlAddProduct($idCommande,$idProduit,$qteProduit)){
                    
                    echo('<script> location.replace("index.php?action=panier"); </script>');
                  }
                  else{
                    throw new Exception("Produit en rupture de stock/en quantité insuffisante");
                  }
                }
            }
            
          // Ajouter un avis à un produit
            
          } else if(isset($_POST['ajouterAvis'])) {
            
              if($_SESSION['logged']) {  
                $pseudoClient=ucfirst($_SESSION['pseudo']);
              } else {
                $pseudoClient=ucfirst($this->getParametre($_POST,'nom'));
              }
              if($this->getParametre($_POST,'genre') == "homme"){
                $genre_img="homme.jpg";
              } else {
                $genre_img="femme.png";
              }
              
              $avis=array('pseudo'=>$pseudoClient,'genre_img'=>$genre_img,'note'=>$this->getParametre($_POST,'stars'),'titre'=>$this->getParametre($_POST,'titre'),'desc'=>$this->getParametre($_POST,'avis'));
              
              $this->ctrlCaracteristiques->ctrlAjouterAvis($idProduit,$avis);
              echo('<script> location.replace("index.php?action=details&idProduit='.$idProduit.'"); </script>');
            }
        }
        
        // Catégories //
        
        else if($_GET['action']=='categorie'){
          $id=intval($this->getParametre($_GET,'idCat'));
          if($id!=0){
            $this->ctrlCategorie->categorie($id);
          }
          else{
            throw new Exception("Identifiant de la catégorie incorrect");
          }
        }
        
        // Inscription //
        
        else if($_GET['action']=='inscription'){
          if(!$_SESSION['logged']){ //Si l'utilisateur n'est pas connecté on affiche la page de connexion
            $this->ctrlInscription->inscription();
            
            // Inscription d'un utilisateur

            if(isset($_POST['validerInscription'])){

              if($this->getParametre($_POST,'mdpInscription')==$this->getParametre($_POST,'confirmerMdpInscription')){
                $pseudo=$this->getParametre($_POST,'pseudoInscription');
                $email=$this->getParametre($_POST,'emailClient');

                if($this->ctrlInscription->ctrlCheckAvaibilityPseudo($pseudo)){ //Si le pseudo et l'adresse mail sont disponibles on peut créer le compte
                  if($this->ctrlInscription->ctrlCheckAvaibilityEmail($email)){
                    $hashMdpInscription=sha1($this->getParametre($_POST,'mdpInscription'));
                    $prenom=$this->getParametre($_POST,'prenomClient');
                    $nom=$this->getParametre($_POST,'nomClient');
                    $add1=$this->getParametre($_POST,'add1Client');
                    $add2=$this->getParametre($_POST,'add2Client');
                    $ville=$this->getParametre($_POST,'villeClient');
                    $cp=$this->getParametre($_POST,'cpClient');
                    $numTel=$this->getParametre($_POST,'numTelClient');

                    $this->ctrlInscription->ctrlRegister($prenom,$nom,$add1,$add2,$ville,$cp,$numTel,$email,$pseudo,$hashMdpInscription);
                    $_SESSION['logged']=true; //Une fois enregistré on connecte l'utilisateur
                    $_SESSION['pseudo']=$pseudo;
                    echo('<script> location.replace("index.php"); </script>');
                  }
                  else{
                    throw new Exception("Email déjà utilisé");
                  }
                }
                else{
                  throw new Exception("Utilisateur déjà existant");
                }
              }
              else{
                throw new Exception("Le mot de passe n'est pas le même");
              }
            } 
            
          // Déconnexion de l'utilisateur  
          
          } else {
            $_SESSION['logged']=false;
            $_SESSION['pseudo']=$_SESSION['id'];
            $_SESSION['admin']=false;
            $this->ctrlPanier->ctrlSupprCustomer($_SESSION['idClient']);
            unset($_SESSION['idClient']);
            echo('<script> location.replace("index.php"); </script>');
          }
        }
        
        // Connexion //
        
        else if($_GET['action']=='connexion'){
          $this->ctrlConnexion->connexion();
          
          // Connecter un utilisateur
          
          if(isset($_POST['validerConnexion'])){
            
            $pseudo=$this->getParametre($_POST,'pseudoConnexion');
            $hashMdpConnexion=sha1($this->getParametre($_POST,'mdpConnexion'));
            
            $idClient=$_SESSION['idClient'];
            
            $idNewClient=$this->ctrlCaracteristiques->ctrlGetCustomerId($pseudo)['customer_id'];
            
            if($this->ctrlCaracteristiques->ctrlCheckOrder($idClient)) {
              if(!$this->ctrlCaracteristiques->ctrlCheckOrder($idNewClient)) {
                $idCommande=$this->ctrlCaracteristiques->ctrlGetIdOrder($idClient,0);
                $idClient=$this->ctrlPanier->ctrlTransfertPanier($idClient,$idCommande,$pseudo);
              } else {
                $idCommande=$this->ctrlCaracteristiques->ctrlGetIdOrder($idClient,0);
                $this->ctrlPanier->ctrlViderPanier($idCommande);
              }
            }
            
            // Si c'est un utilisateur lambda
            
            if($this->ctrlConnexion->ctrlCheckUser($pseudo,$hashMdpConnexion)){
              $_SESSION['logged']=true;
              $_SESSION['pseudo']=$pseudo;
              header('Location:index.php');
              exit();
              
            // Si c'est un admin
              
            } else if($this->ctrlConnexion->ctrlCheckAdmin($pseudo,$hashMdpConnexion)){
              $_SESSION['logged']=true;
              $_SESSION['pseudo']=$pseudo;
              $_SESSION['admin']=true;
              header('Location:index.php');
              exit();
            }
            else{
              throw new Exception("Mauvais pseudo/mot de passe");
            }
          }
        }
        
        // Panier //
        
        else if($_GET['action']=='panier'){
          
          // Panier d'un utilisateur connecté

          if($_SESSION['logged']){
            $pseudoClient=$this->getParametre($_SESSION,'pseudo');

            $client=$this->ctrlCaracteristiques->ctrlGetCustomerId($pseudoClient);
            $idClient=$client['customer_id'];
              if($this->ctrlCaracteristiques->ctrlCheckOrder($idClient)) {
              $idCommande=$this->ctrlCaracteristiques->ctrlGetIdOrder($idClient,0);

              $this->ctrlPanier->ctrlSetTotalOrder($idCommande);

              $this->ctrlPanier->panierCommande($idClient,$idCommande);

              if(isset($_POST['viderPanier'])) {
                $this->ctrlPanier->ctrlViderPanier($idCommande);
                echo('<script> location.replace("index.php?action=panier"); </script>');
              }
            }
            else{
              $this->ctrlPanier->panier();
            }
            
          // Panier d'un utilisateur non connecté
            
          } else {
              $idClient=$_SESSION['idClient'];
            
              if($this->ctrlCaracteristiques->ctrlCheckOrder($idClient)) {
              $idCommande=$this->ctrlCaracteristiques->ctrlGetIdOrder($idClient,0);

              $this->ctrlPanier->ctrlSetTotalOrder($idCommande);

              $this->ctrlPanier->panierCommande($idClient,$idCommande);

              if(isset($_POST['viderPanier'])) {
                $this->ctrlPanier->ctrlViderPanier($idCommande);
                echo('<script> location.replace("index.php?action=panier"); </script>');
              }
            }
            else{
              $this->ctrlPanier->panier();
            }
          }
        }
        
        // Mon compte //
        
        else if($_GET['action']=='moncompte') {
          
          // Page réservée aux utilisateur connecté lambda/admin
          
          if($_SESSION['logged']) {
            if(!$_SESSION['admin']) {
              $pseudoClient=$this->getParametre($_SESSION,'pseudo');

              $client=$this->ctrlCaracteristiques->ctrlGetCustomerId($pseudoClient);
              $idClient=$client['customer_id'];
              $this->ctrlMonCompte->monCompte($idClient);

              // Change le mdp du compte si l'utilisateur l'utilise correctement
              if(isset($_POST['validerChgtMdp'])) {

                $newMdp=$this->getParametre($_POST,'newMdp');
                $confirmNewMdp=$this->getParametre($_POST,'confirmNewMdp');

                if($newMdp==$confirmNewMdp) {

                  $pseudo=$this->getParametre($_SESSION,'pseudo');
                  $oldHashMdp=sha1($this->getParametre($_POST,'oldMdp'));
                  if($this->ctrlMonCompte->ctrlCheckMdp($pseudo,$oldHashMdp)) {

                    $newHashMdp=sha1($newMdp);
                    $this->ctrlMonCompte->ctrlChangePass($pseudo,$newHashMdp);
                  } else {
                    throw new Exception("Mauvais ancien mot de passe");
                  } 
                } else {
                  throw new Exception("Le nouveau mot de passe doit être le même que celui confirmé");
                }
              }
            } else {
              
              // Confirmer l'expédition d'une commande
              
              $this->ctrlMonCompte->monCompte();
              if(isset($_POST['expeCommande'])) {
                $idCommande = $this->getParametre($_POST,'idCommande');
                $this->ctrlMonCompte->ctrlExpeCommande($idCommande);
                echo('<script> location.replace("index.php?action=moncompte"); </script>');
                
              // Confirmer la réception du chèque de la commande  
              
              } elseif(isset($_POST['chequeCommande'])) {
                $idCommande = $this->getParametre($_POST,'idCommande');
                $this->ctrlMonCompte->ctrlChequeCommande($idCommande);
                echo('<script> location.replace("index.php?action=moncompte"); </script>');
              }
            }
          } else {
            echo('<script> location.replace("index.php"); </script>');
          }
        }

        // Adresse //

        else if($_GET['action']=='saisirAdresse'){
          
          if($_SESSION['logged']) {
            $pseudoClient=$this->getParametre($_SESSION,'pseudo');
            $client=$this->ctrlCaracteristiques->ctrlGetCustomerId($pseudoClient);
            $idClient=$client['customer_id'];
          } else {
            $idClient=$_SESSION['idClient'];
          }
          
          $idCommande=$this->ctrlCaracteristiques->ctrlGetIdOrder($idClient,0);

          $this->ctrlAdresse->adresse($idClient);

          // Créer une nouvelle adresse
          
          if(isset($_POST['validerNewAdresse'])){
            //On créé une nouvelle adresse dans delivery_addresses avec les valeurs du formulaire
            $prenom=$this->getParametre($_POST,'prenomClient');
            $nom=$this->getParametre($_POST,'nomClient');
            $add1=$this->getParametre($_POST,'add1Client');
            $add2=$this->getParametre($_POST,'add2Client');
            $ville=$this->getParametre($_POST,'villeClient');
            $cp=$this->getParametre($_POST,'cpClient');
            $numTel=$this->getParametre($_POST,'numTelClient');
            $email=$this->getParametre($_POST,'emailClient');

            $resultat = $this->ctrlAdresse->ctrlCreateNewAdd($idCommande,$prenom,$nom,$add1,$add2,$ville,$cp,$numTel,$email);
            $idAdr=$resultat['id'];

            //On remplit table orders avec id adresse
            $this->ctrlAdresse->ctrlUpdateAdrId($idAdr,$idCommande);

            //On passe le statut de la commande à 1
            $this->ctrlAdresse->ctrlUpdateStatusOrder($idCommande,1);

            echo('<script> location.replace("index.php?action=paiement"); </script>');
          
          // Utiliser une adresse déjà enregistrée
            
          } else if(isset($_POST['validerAdresse'])) {

            $resultat = $this->ctrlAdresse->ctrlCreateAdd($idClient,$idCommande);
            $idAdr=$resultat['id'];

            //On remplit table orders avec id adresse
            $this->ctrlAdresse->ctrlUpdateAdrId($idAdr,$idCommande);

            //On passe le statut de la commande à 1
            $this->ctrlAdresse->ctrlUpdateStatusOrder($idCommande,1);

            echo('<script> location.replace("index.php?action=paiement"); </script>');
          }
        }
        
        // Paiement
        
        else if($_GET['action']=='paiement') {
          
          if($_SESSION['logged']){
            $pseudoClient=$this->getParametre($_SESSION,'pseudo');
            $client=$this->ctrlCaracteristiques->ctrlGetCustomerId($pseudoClient);
            $idClient=$client['customer_id'];
          } else {
            $idClient=$_SESSION['idClient'];
          }
          
          
          $idCommande=$this->ctrlCaracteristiques->ctrlGetIdOrder($idClient,1);
          $_SESSION['idOrder'] = $idCommande;
          
          $this->ctrlPaiement->paiement();
          
          // Les deux types de paiement différents (possibilité d'en implémenter)
          
          if(isset($_POST['paypalPaiement'])) {
            $this->ctrlPaiement->ctrlPaid("paypal",$idCommande);
            echo('<script> location.replace("index.php?action=macommande"); </script>');
          } elseif(isset($_POST['chequePaiement'])) {
            $this->ctrlPaiement->ctrlPaid("cheque",$idCommande);
            echo('<script> location.replace("index.php?action=macommande"); </script>');
          }
          
        }
        
        // Ma Commande //
        
        else if($_GET['action']=='macommande') {
          
          // Affichage simple de la page maCommande
          
          $this->ctrlMaCommande->maCommande($_SESSION['idOrder']);
          
        }
             
        // Action non valide //
             
        else{
          throw new Exception("Action non valide");
        }
      }
      else{ //Aucune action définie : affichage de l'accueil
        $this->ctrlAccueil->accueil();
      }
    }
    catch(Exception $e){
      $this->erreur($e->getMessage());
    }  
  }

  // Affiche une erreur
  
  private function erreur($msgErreur){
    $vue = new Vue ("Erreur");
    $vue->generer(array('msgErreur' => $msgErreur));
  }

  // Recherche un paramètre dans un tableau
  
  private function getParametre($tableau,$nom){
    if(isset($tableau[$nom])){
      return $tableau[$nom];
    }
    else{
      throw new Exception("Paramètre '$nom' absent");
    }
  } 

}
