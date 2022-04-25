<?php
//on insère le fichier qui contient les fonctions
include_once '../modeles/mesFonctionsAccesAuxDonnees.php';
$pdo = connexionBDD();
var_dump(donneLesVilles($pdo));