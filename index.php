<?php

// Page index démarrant le routeur + la session

require 'Controleur/routeur.php';
session_start();
$routeur = new Routeur();
$routeur->routerRequete();  
  