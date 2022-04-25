<?php

include_once '../../modeles/mesFonctionsAccesAuxDonnees.php';

$table="bien";
$colonne1="ref";
$colonne2="rue";
$colonne3="cp";
$colonne4="ville";

$rue= htmlspecialchars($_POST['rue']);
$cp= htmlspecialchars(trim($_POST['cp']));
$ville= htmlspecialchars($_POST['ville']);
$prix= htmlspecialchars(trim($_POST['prix']));
$type= htmlspecialchars(trim($_POST['type']));
$ref= htmlspecialchars($_POST['ref']);
$jardin= htmlspecialchars(trim($_POST['jardin']));
$surface= htmlspecialchars(trim($_POST['surface']));
$nbpiece= htmlspecialchars(trim($_POST['nbpiece']));

//verifier format reference valide
if (strlen($rue)<=recupTailleMax(connexionBDD(), $table, $colonne2)
&& strlen($cp)<=recupTailleMax(connexionBDD(), $table, $colonne3) 
&& strlen($ville)<=recupTailleMax(connexionBDD(), $table, $colonne4)
&& strlen($prix)<=9 && strlen($surface)<=6 && strlen($nbpiece)<=3
&& strlen($ref)<= recupTailleMax(connexionBDD(), $table, $colonne1)){ 
    
    $pdo= connexionBDD();
    if (testRef($pdo,$ref)==false){
        $del1=supprimerImages($pdo, $ref);
        if($del1==True){
            $del2=supprimerBien($pdo, $ref);
            if($del2==True){
                header('Location: supprimerBien.php');
            }else{
                echo "Le bien n'a pas été supprimé, il n'existe pas <br/>";
            }
        }else{
           echo "L'image n'a pas été supprimée, elle n'existe pas <br/>";
        }
    }else{ 
        echo "La réference est déjà utilisé <br/>";
    }
    
}else{
    echo "La longueur de la rue, du code postal, de la ville et/ou du prix n'est pas valide <br/>";
}