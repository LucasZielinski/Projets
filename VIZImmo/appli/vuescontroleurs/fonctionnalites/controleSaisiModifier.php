<?php

include_once '../../modeles/mesFonctionsAccesAuxDonnees.php';

if(isset($_POST['supprimerUneImage'])){
    $idPrise = substr($_POST['supprimerUneImage'], 22, 26);
    $id = (int)$idPrise;
    $pdo = connexionBDD();
    $ref= htmlspecialchars(trim($_POST['ref']));
    $lecodeimg = donneUneImage($pdo, $id);
    $uncodeimg = implode($lecodeimg);
    $longueur = strlen($uncodeimg)+1;
    $codeimg = substr($uncodeimg,0,($longueur/2));
    unlink('../'.$codeimg);
    supprimerUneImage($pdo, $id);
}

if(isset($_POST) && !empty($_POST)){   
    if($_FILES['nouvelleImage']['error'] == 0){
        if($_FILES['nouvelleImage']['size'] > 500000){
           $erreur = 'Votre fichier est trop lourd';
        }
        if(!isset($erreur)){
            $ref= htmlspecialchars(trim($_POST['ref']));                  
            $extension = $_FILES['nouvelleImage']['name'];
            $type= htmlspecialchars($_POST['lestypes']);
            if ($type == 1){
                $type = 'Appart';
            }
            if ($type == 2){
                $type = 'Immeuble';
            }
            if ($type == 3){
                $type = 'Local';
            }
            if ($type == 4){
                $type = 'Maison';
            }
            if ($type == 5){
                $type = 'Terrains';
            } 
            $pdo = connexionBDD();
            $id = getId($pdo);
            $codeimg = '../img/'.$type.'/'.$ref.'/'.$extension;
            move_uploaded_file($_FILES['nouvelleImage']['tmp_name'], '../../img/'.$type.'/'.$ref.'/'.$_FILES['nouvelleImage']['name']); 
            ajouterImage($pdo, $id+1, $ref,$codeimg);
        }  
    }else{
        $erreur = 'Image non chargée';
    }
}

$rue= htmlspecialchars($_POST['rue']);
$cp= htmlspecialchars(trim($_POST['cp']));
$ville= htmlspecialchars($_POST['ville']);
$prix= htmlspecialchars(trim($_POST['prix']));
$type= htmlspecialchars($_POST['lestypes']);
$ref= htmlspecialchars($_POST['ref']);
$jardin= htmlspecialchars(trim($_POST['lesjardins']));
$surface= htmlspecialchars(trim($_POST['surface']));
$nbpiece= htmlspecialchars(trim($_POST['nbpiece']));

//verifier format reference valide
if (strlen($rue)<=recupTailleMax(connexionBDD(), "bien", "rue")
&& strlen($cp)<=recupTailleMax(connexionBDD(), "bien", "cp") 
&& strlen($ville)<=recupTailleMax(connexionBDD(), "bien", "ville")
&& strlen($prix)<=9 && strlen($surface)<=6 && strlen($nbpiece)<=3
&& strlen($ref)<= recupTailleMax(connexionBDD(), "bien", "ref")){ 
    
    $pdo= connexionBDD();
    modifierBien($pdo, $rue, $cp, $ville, $prix, $type, $jardin, $surface, $nbpiece, $ref);
    header('Location: voirLeBienAModifier.php?lesRefs='.$_POST['ref']);
}