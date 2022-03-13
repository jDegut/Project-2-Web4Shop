<?php $this->titre=$caracteristiques['name'];?>

<!-- Affichage des infos du produit -->

<div class="col-8 bg-light mx-auto mt-3" style="border-radius: 12px;">
  <div class="row align-items-center">
    <div class="col text-center ms-2 vert-sep py-3">
      <img src="<?= "Contenu/Images/".$caracteristiques['image']?>" style="width:400px;
                                                                           height:400px;
                                                                           box-shadow: 0 30px 40px rgba(0,0,0,.1);">
    </div>
    <div class="col text-center">
      <div class="row">
        <h1><?=$caracteristiques['name']?></h1>
        <a href="<?= "index.php?action=categorie&idCat=".$categorie['id']?>">Voir tous les <?=$categorie['name']?></a>
        <p><?=$caracteristiques['description']; ?></p> 
        <p>Prix : <?=$caracteristiques['price']; ?> €</p> 

        <?php if(!$_SESSION['admin']):?>
        <form action="<?="index.php?action=details&idProduit=".$caracteristiques['id'];?>" method="POST">
          <div class="container mb-3">
            <p class="mb-2">Choisissez la quantité :</p><input type="number" name="qte" class="form-control mx-auto" style="width:60px;" min="1" max="20" required/>
          </div>
          <input class="btn btn-danger button" type="submit" name="ajoutPanier" value="Ajouter au panier">
        </form>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>

<!-- Affichage des avis et du formulaire pour en donner un -->

<div class="col-8 bg-light mx-auto mt-5" style="border-radius: 12px;">
  <div class="row align-items-center text-center p-3">
    <h3>Leurs avis sur ce produit</h3>
  </div>
  <hr/>
  <?php foreach($reviews as $rev):?>
  <div class="row align-items-center text-center">
    <div class="col">
      <img src="Contenu/Images/<?=$rev['photo_user']?>" style="height:150px;width:150px;">
    </div>
    <div class="col">
      <p><?=$rev['name_user']?></p>
    </div>
    <div class="col">
      <?php for($i=0;$i<$rev['stars'];$i++):?>
      <img src="Contenu/Images/review_star.png" style="height:20px;width:20px;">
      <?php endfor;
      for($i=0;$i<5-$rev['stars'];$i++):?>
      <img src="Contenu/Images/review_gray.png" style="height:20px;width:20px;">
      <?php endfor;?>
    </div>
    <div class="col me-3">
      <h5><?=$rev['title']?></h5>
      <p><?=$rev['description']?></p>
    </div>
  </div>
  <hr/>
  <?php endforeach;?>
  <?php if(!$_SESSION['admin']):?>
  <div class="row align-items-center text-center p-3 mb-3">
    <h3>Donner un avis sur le produit</h3>
    <form action="index.php?action=details&idProduit=<?=$caracteristiques['id']?>" method="POST">
      <div class="row align-items-center text-center">
        <div class="col-2">
          <?php if(!$_SESSION['logged']){?>
          Votre nom : <input type="text" class="form-control" name="nom" required>
          <?php }else{?>
          Votre nom : <?=$_SESSION['pseudo']?>
          <?php }?>
        </div>
        <div class="col-1">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="genre" value="homme" checked>
            <label class="form-check-label" for="homme">
              Homme
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="genre" value="femme">
            <label class="form-check-label" for="femme">
              Femme
            </label>
          </div>
        </div>
        <div class="col-2">
          Note sur 5
          <input type="number" class="form-control mx-auto" min="0" max="5" name="stars" style="width:50%" required>
        </div>
        <div class="col-3">
          Titre : <input type="text" class="form-control" name="titre" required>
        </div>
        <div class="col-4">
          Avis : <input type="text" class="form-control" name="avis" required>
        </div>
      </div>
      <div class="row align-items-center text-center mt-3">
        <div class="col">
          <input type="submit" class="btn btn-danger" name="ajouterAvis" value="Envoyer">
        </div>
      </div>
    </form>
  </div>
  <?php endif;?>
</div>
