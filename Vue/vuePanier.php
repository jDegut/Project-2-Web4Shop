<?php $this->titre='WEB 4 SHOP : Votre Panier'; ?>

<!-- Affichage du panier (si non vide) -->

<div class="col-11 bg-light mx-auto mt-3" style="border-radius: 12px;">
  <div class="row pt-2">
    <div class="col text-center"><h1>Mon panier</h1></div>
    <hr/>
  </div>
  <?php if(isset($produits) && count($produits) > 0):
        foreach($produits as $produit): ?>
  <div class="row align-items-center pt-2">
    <div class="col text-center">
      <img src="<?= "Contenu/Images/".$produit['image']?>" style="height:100px;width=100px;">
    </div>
    <div class="col text-center">
      <p><?=$produit['name']?></p>
    </div>
    <div class="col text-center">
      <p>Prix unité : <?=$produit['price'] ?> €</p>
    </div>
    <div class="col text-center">
      <p>Quantité : <?=$produit['quantity'] ?></p>
    </div>
    <div class="col text-center">
      <p>Sous-total : <?=$produit['price'] * $produit['quantity'] ?> €</p>
    </div>
  </div>
  <?php if(count($produits) >= 1) {echo('<hr/>');} ?>
  <?php endforeach; ?>
  <div class="row pb-3">
    <div class="col text-center"><a href="index.php?action=saisirAdresse" class="btn btn-danger">Passer la commande</a></div>
    <div class="col text-center"><form action="index.php?action=panier" method="POST"><input type="submit"  name="viderPanier" class="btn btn-danger" value="Vider le panier.."></form></div>
    <div class="col text-center">Total à payer (TTC) : <?=$totalPrice?> €</div>
  </div>
  
  <!-- Affichage du panier (vide) -->
  
  <?php elseif(((isset($produits)) and count($produits) == 0) or (!isset($produits))):?>
  <div class="row align-items-center py-5">
    <div class="col text-center">
      <h3>Le panier est vide...</h3>
      <a href="index.php" class="text-decoration-none">Commencer à faire mes achats !</a>
    </div>
  </div>
  <?php endif;?>
</div>