<?php
include_once '../modeles/mesFonctionsAccesAuxDonnees.php';

//appel de la fonction qui permet de se connecter à la base de données
$lePdo = connexionBDD();


// Check connection
if (!$lePdo) {
      die("Échec de la connexion");
}
 
echo "Connexion réussie";

$mdp= password_hash("020599", PASSWORD_DEFAULT);

$sth=$lePdo->prepare("INSERT INTO utilisateur (id, login, mdp) VALUES (null, 'agent1',:mdp)");
$bvc2 = $sth
            ->bindValue(':mdp',$mdp,PDO::PARAM_STR);
$sth->execute();

if ($sth) {
      echo "Nouveau enregistrement créé avec succès";
} else {
      echo "Erreur";
}
deconnexionBDD($lePdo);

