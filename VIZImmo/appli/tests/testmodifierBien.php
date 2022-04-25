<?php
//on insère le fichier qui contient les fonctions
include_once '../modeles/mesFonctionsAccesAuxDonnees.php';

//appel de la fonction qui permet de se connecter à la base de données
$lePdo = connexionBDD();

//var_dump permet d'afficher le contenu d'un objet. Utilisable uniquement lors de test de validation
var_dump(modifierBien($lePdo,'59 rue de la Citadelle','59000','Lille',1152000,3,0,475,20,'L3'));