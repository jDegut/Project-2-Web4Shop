<?php $this->titre='WEB 4 SHOP : Saisir adresse'; ?>

<!-- Adresse déjà enregistrée (si utilisateur connecté) -->

<div class="col-11 bg-light mx-auto mt-3" style="border-radius: 12px;">
  <div class="row align-items-center">
    <?php if($_SESSION['logged']):?>
    <div class="col text-center">
      <form action="index.php?action=saisirAdresse" method="POST">
        <legend>Adresse enregistrée</legend>
        <p>Prénom : <?=$info['forname']; ?></p>
        <p>Nom : <?=$info['surname']; ?></p>
        <p>Adresse 1 : <?=$info['add1']; ?></p>
        <p>Adresse 2 : <?=$info['add2']; ?></p>
        <p>Ville : <?=$info['add3']; ?></p>
        <p>Code postal : <?=$info['postcode']; ?></p>
        <p>Numéro de téléphone : <?=$info['phone']; ?></p>
        <p>Email : <?=$info['email']; ?></p>
        <input class="button btn btn-danger" type="submit" name="validerAdresse" value="Utiliser ces informations">
      </form>
    </div>
    
<!--Nouvelle adresse (si utilisateur connecté) -->
    
    <div class="col vert-sep">
      <form action="index.php?action=saisirAdresse" method="POST">

        <legend>Choisir une autre adresse</legend>
        
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
        <div class="text-center mb-2">
          <input type="submit" class="button btn btn-danger mb-3" name="validerNewAdresse" value="Valider">
        </div>

      </form>
    </div>
    
<!--Nouvelle adresse (si utilisateur non connecté) -->

    
    <?php else:?>
    <div class="col-6 py-3 mx-auto">
      <form action="index.php?action=saisirAdresse" method="POST">

        <legend>Entrer son adresse</legend>
        
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
        <div class="text-center mb-2">
          <input type="submit" class="button btn btn-danger mb-3" name="validerNewAdresse" value="Valider">
        </div>

      </form>
    </div>
    <?php endif;?>
  </div>
</div>
