<?php
include_once '../modeles/mesFonctionsAccesAuxDonnees.php';
$login="agent1";
$mdp="020519";

echo "test de connexion echouee";
var_dump(verifieAuthentification(connexionBDD(),"agent2","$mdp"));
echo "Test de connexion reussie";
var_dump(verifieAuthentification(connexionBDD(),$login,$mdp));
