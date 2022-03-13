<?php $this->titre='WEB 4 SHOP : Connexion'; ?>

<!-- Formulaire de connexion -->

<div class="col-11 bg-light mx-auto mt-3" style="border-radius: 12px;">
  <div class="row align-items-center">
    <div class="col text-center ms-2">
      <h2>Pas encore inscrit ?</h2>
      <p>Vous pouvez vous inscrire via ce <a href="index.php?action=inscription">lien</a> et commencer
      à faire vos achats !</p>
    </div>
    <div class="col vert-sep">
      <form action="index.php?action=connexion" method="POST">
        <h1 class="text-center my-3">Connexion</h1>
        <legend>Informations du compte</legend>
        <div class="mb-3">
          <label for="pseudo" class="form-label">Pseudo :</label>
          <input type="text" class="form-control" name="pseudoConnexion" required>
        </div>
        <div class="mb-3">
          <label for="motdepasse" class="form-label">Mot de passe :</label>
          <input type="password" class="form-control" name="mdpConnexion" required>
        </div>
        <div class="text-center mb-3">
          <input type="submit" class="button btn btn-danger px-5" name="validerConnexion" value="Se connecter">
        </div>
      </form>
    </div>
  </div>
</div>
