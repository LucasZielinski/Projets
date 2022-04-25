<?php
include_once '../modeles/mesFonctionsAccesAuxDonnees.php';
$bdd= connexionBDD();
if(isset($_POST['code'],$_POST['newMdp'])){
    $verifcode=$bdd->prepare('SELECT id FROM recuperation WHERE code = ?');
    $verifcode->execute(array($_POST['code']));
    $verifcode=$verifcode->rowCount();
    if($verifcode==1){
        $newMdp=password_hash($_POST['newMdp'],PASSWORD_DEFAULT);
        
        $changementMdp=$bdd->prepare('UPDATE utilisateur SET mdp = ?');
        $changementMdp->execute(array($newMdp));
        $supprimerCode=$bdd->prepare('DELETE FROM recuperation WHERE code = ?');
        $supprimerCode->execute(array($_POST['code']));
    }
}
else{
    echo "ERREUR";
}

header('location:../index.php');



