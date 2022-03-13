<!-- Template du site entier -->

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Contenu/Style/style.css"/>
    <title><?=$titre?></title>
  </head>
  
  <body style="background: rgb(45,45,45);">
    <div class="container-fluid">
      
      <!-- Menu flottant -->
      
      <div id="menu" class="row fixed-top justify-content-between" 
           style="background-color: rgb(35,35,35);">
        <div class="col">
          <a href="index.php" class="text-decoration-none d-inline-flex">
          <img src="Contenu/Images/logo.png" style="width: 150px; height: 100px;"><h1 class="fst-italic fw-bold my-auto d-none d-md-block" style="letter-spacing:3px; font-family: Serif; color: rgb(230, 106, 106); text-shadow: 1px 1px 2px rgb(113, 54, 156);">Web 4 Shop</h1></a>
        </div>
        <div class="col text-center d-flex justify-content-end align-items-center me-3">
          <?php
            if($_SESSION['logged']){
              if(!$_SESSION['admin']) {
                echo ('<a href=index.php?action=moncompte class="buttn text-uppercase">');
                echo ($_SESSION["pseudo"].'</a>');
              } else {
                echo ('<a href=index.php?action=moncompte class="buttn text-uppercase">');
                echo ('Admin</a>');                
              }
                echo ('<a style="margin-left:10px;" href=index.php?action=inscription class="buttn">');
                echo ('Déconnexion</a>');
            }
            else {
              echo ('<a href=index.php?action=inscription class="buttn">');
              echo ('Inscription</a>');
              echo ('<a style="margin-left:10px;" href=index.php?action=connexion class="buttn">');
              echo ('Connexion</a>');
            }
            if(!$_SESSION['admin']){
            echo ('<a style="margin-left:10px;" href=index.php?action=panier class="buttn-panier">');
            echo ('<img src="Contenu/Images/logo-panier.png" style="width:45px; height:45px;"></a>');
            }?>
        </div>
      </div>      
      <div style="height: 100px"></div>
      
      <!-- Affichage du contenu de la page -->
      
      <?=$contenu?>
    </div>
    
    <!-- Bande footer -->

    
    <div style="height: 100px"></div>
    <div id="footer" class="row bg-light fixed-bottom py-3" style="opacity:0;">
      <div class="col text-center">
        <a class="text-decoration-none text-dark fst-italic fs-5" href="index.php">Revenir a l'accueil</a>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="Contenu/Scripts/scroll-nav.js"></script>
  </body>
</html>