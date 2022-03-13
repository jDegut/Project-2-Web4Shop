<?php $this->titre='WEB 4 SHOP : Inscription'; ?>

<!-- Formulaire d'inscription -->

<div class="col-11 bg-light mx-auto mt-3" style="border-radius: 12px;">
  <div class="row align-items-center">
    <div class="col vert-sep ms-2">
      <form action="index.php?action=inscription" method="POST">
        <h1 class="text-center my-3">Inscription</h1>
        <legend>Informations du compte</legend>
        <div class="mb-3">
          <label for="pseudo" class="form-label">Pseudo :</label>
          <input type="text" class="form-control" name="pseudoInscription" required>
        </div>
        <div class="mb-3">
          <label for="motdepasse" class="form-label">Mot de passe :</label>
          <input type="password" class="form-control" name="mdpInscription" required>
        </div>
        <div class="mb-3">
          <label for="confirmMotdepasse" class="form-label">Confirmation du mot de passe :</label>
          <input type="password" class="form-control" name="confirmerMdpInscription" required>
        </div>
        <hr style="border: 1px solid gray;"/>
        <legend>Informations personnelles</legend>
        <div class="mb-3">
          <label for="prenom" class="form-label">Prénom :</label>
          <input type="text" class="form-control" name="prenomClient" required>
        </div>
        <div class="mb-3">
          <label for="nom" class="form-label">Nom :</label>
          <input type="text" class="form-control" name="nomClient" required>
        </div>
        <div class="mb-3">
          <label for="adresse1" class="form-label">Adresse 1 :</label>
          <input type="text" class="form-control" name="add1Client" required>
        </div>
        <div class="mb-3">
          <label for="adresse2" class="form-label">Adresse 2 :</label>
          <input type="text" class="form-control" name="add2Client" required>
        </div>
        <div class="mb-3">
          <label for="ville" class="form-label">Ville :</label>
          <input type="text" class="form-control" name="villeClient" required>
        </div>
        <div class="mb-3">
          <label for="codePostal" class="form-label">Code Postal :</label>
          <input type="text" class="form-control" name="cpClient" required>
        </div>
        <div class="mb-3">
          <label for="telephone" class="form-label">Numéro de téléphone :</label>
          <input type="tel" class="form-control" name="numTelClient" required>
        </div>
        <div class="mb-3">
          <label for="emil" class="form-label">Email :</label>
          <input type="email" class="form-control" name="emailClient" required>
        </div>
        <div class="text-center mb-3">
          <input type="submit" class="button btn btn-danger px-5" name="validerInscription" value="S'inscrire">
        </div>
      </form>
    </div>
    <div class="col text-center">
      <h2>Déja inscrit ?</h2>
      <p>Vous pouvez vous connecter via ce <a href="index.php?action=connexion">lien</a> et commencer
      à faire vos achats !</p>
    </div>
  </div>
</div>
