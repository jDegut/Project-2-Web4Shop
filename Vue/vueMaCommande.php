<?php $this->titre='WEB 4 SHOP : Ma commande'; ?>

<!-- Affichage de la commande effectuée -->

<div class="col-11 bg-light mx-auto mt-3" style="border-radius: 12px;">
  <div class="row align-items-center">
    <div class="col text-center pt-2">
      <h2>Merci pour votre commande !</h2>
      <hr/>
      <div class="row align-items-center pt-2">
        <h5 class="fst-italic">Mes produits</h5>
      </div>
      <?php foreach($produits as $produit):?>
      <div class="row align-items-center pt-2">
        <div class="col text-center">
          <img src="<?= "Contenu/Images/".$produit['image']?>" style="height:100px;width=100px;">
        </div>
        <div class="col text-center">
          <p><?=$produit['name']?></p>
        </div>
        <div class="col text-center">
          <p>Prix unité : <?=$produit['price']; ?> €</p>
        </div>
        <div class="col text-center">
          <p>Quantité : <?=$produit['quantity']; ?></p>
        </div>
        <div class="col text-center">
          <p>Sous-total : <?=$produit['price'] * $produit['quantity']; ?> €</p>
        </div>
      </div>
      <?php if(count($produits) > 1) {echo('<hr/>');}?>
      <?php endforeach;?>
      <div class="row align-items-center pt-2">
        <p>Total de la commande : <?=$info['total']?> €</p>
        <h5 class="fst-italic">Votre paiement</h5>
        <p>Type de paiement choisi : <?=strtoupper($info['payment_type'])?></p>
        <?php if($info['payment_type'] == "cheque"):?>
        <p>Veuillez envoyer un chèque à : WEB 4 SHOP, 75000, PARIS</p>
        <p>d'un montant de <?=$info['total']?> € et d'ordre WEB 4 SHOP.</p>
        <?php endif; ?>
        <p>Votre commande sera expediée uniquement dès la réception de ce dernier.</p>
      </div>
      
<!-- Facture -->
      
      <div class="row align-items-center pt-2">
        <h5 class="fst-italic">Votre Facture</h5>
        <a href="Contenu/factures.php?id=<?=$info['id']?>" class="text-decoration-none">Cliquez ici pour télécharger votre facture</a>
      </div>
      <hr/>
      <div class="row align-items-center py-2">
        <h6>Toute l'équipe de WEB 4 SHOP vous remercie pour la confiance que vous nous donnez, et espère que vous apprécierez nos produits</h6>
      </div>
    </div>
  </div>
</div>
