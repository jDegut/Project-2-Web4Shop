<?php $this->titre='WEB 4 SHOP : Paiement'; ?>

<!-- Affichage des méthodes de paiement -->

<div class="col-11 bg-light mx-auto mt-3" style="border-radius: 12px;">
  <div class="row align-items-center">
    <div class="col-6 py-5 mx-auto text-center">
      <form action="index.php?action=paiement" method="POST">
        <legend>Paiement</legend>
        <p>Je souhaite régler par :</p>
        <a href="http://www.paypal.com/" target="_blank"><input type="submit" class="btn btn-danger" name="paypalPaiement" value="PayPal"></a>
        <input type="submit" class="btn btn-danger" name="chequePaiement" value="Chèque">
      </form>
    </div>
  </div>
</div>