<?php
include_once '../modeles/mesFonctionsAccesAuxDonnees.php';
$nom_table="utilisateur";
$nom_colonne="login";
echo "Test login utilisateurs";
var_dump(recupTailleMax(connexionBDD(),$nom_table,$nom_colonne));