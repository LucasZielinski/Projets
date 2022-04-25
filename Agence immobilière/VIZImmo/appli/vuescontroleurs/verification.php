<?php
session_start();
include_once '../modeles/mesFonctionsAccesAuxDonnees.php';

$_SESSION['username']=null;
$username=htmlspecialchars(trim($_POST['username']));
$password=htmlspecialchars(trim($_POST['password']));

$table="utilisateur";
$colonne1="login";
$colonne2="mdp";
if (strlen($username)<= recupTailleMax(connexionBDD(), $table, $colonne1) 
&& strlen($password)<=recupTailleMax(connexionBDD(), $table, $colonne2)){

    if(isset($username) && isset($password)){
    
        if($username !== "" && $password !== ""){
            
            if(verifieAuthentification(connexionBDD(),$username,$password)){
                $_SESSION['username'] = $username;
                header('Location: ../index.php');
        }
            else header('Location: connexionAgent.php');
            
        
        
}
}
}
else header('Location: connexionAgent.php');