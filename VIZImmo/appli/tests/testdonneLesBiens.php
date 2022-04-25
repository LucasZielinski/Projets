<?php

// On insère le fichier qui contient les fonctions

include_once '../modeles/mesFonctionsAccesAuxDonnees.php';

// Appel de la fonction pour se connecter à la BDD

$lePdo = connexionBDD();

// Test d'affichage du contenue

var_dump($lePdo);
var_dump(donneLesBiens($lePdo));





