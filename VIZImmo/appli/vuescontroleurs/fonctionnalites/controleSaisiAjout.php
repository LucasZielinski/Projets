<?php

include_once '../../modeles/mesFonctionsAccesAuxDonnees.php';

$table="bien";
$colonne1="ref";
$colonne2="rue";
$colonne3="cp";
$colonne4="ville";

$ref= htmlspecialchars(trim($_POST['reference']));
$rue= htmlspecialchars($_POST['rue']);
$cp= htmlspecialchars(trim($_POST['cp']));
$ville= htmlspecialchars($_POST['ville']);
$prix= htmlspecialchars(trim($_POST['prix']));
$type= htmlspecialchars($_POST['lestypes']);
$jardin= htmlspecialchars($_POST['lesjardins']);
$surface= htmlspecialchars($_POST['surface']);
$nbpiece= htmlspecialchars($_POST['nbpiece']);
$countfiles = count($_FILES['monfichier']['name']);
echo $countfiles;
echo ($_FILES['monfichier']['name'][0]);
echo ($_FILES['monfichier']['name'][1]);

//verifier format reference valide
if (strlen($ref)<= recupTailleMax(connexionBDD(), $table, $colonne1) 
&& strlen($rue)<=recupTailleMax(connexionBDD(), $table, $colonne2)
&& strlen($cp)<=recupTailleMax(connexionBDD(), $table, $colonne3) 
&& strlen($ville)<=recupTailleMax(connexionBDD(), $table, $colonne4)
&& strlen($prix)<=9
&& strlen($surface)<=6
&& strlen($nbpiece)<=3)
{ 
    

    
    // tester si reference deja présent
    $pdo= connexionBDD();
    // si dans cette fonction la ref existe : ok
    if (testRef($pdo,$ref)==True){
        //insertion dans la bdd
        ajouterBien($pdo, $ref, $rue, $cp, $ville, $prix, $type, $jardin, $surface, $nbpiece);        
    }else{
        // si cette référence existe deja -> affichage message 
        echo "La réference est déjà utilisé <br/>";
    }
}else{
    echo "La longueur de la référence, de la rue, du code postal, de la ville, du prix, de la surface, et/ou du nombre de pièces n'est pas valide <br/>";
}

for($i=0;$i<$countfiles;$i++){
    
if(isset($_POST) && !empty($_POST)){  
    
    if($_FILES['monfichier']['error'][$i] == 0){
        
        // test taille        
        if($_FILES['monfichier']['size'][$i] > 500000){
           $erreur = 'Votre fichier est trop lourd';
        }
       
        // Ajout BDD
        
        if(!isset($erreur)){
            $ref= htmlspecialchars(trim($_POST['reference']));                  
            $extension = $_FILES['monfichier']['name'][$i];
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
                $type = 'Terrain';
            }            
            $id = getId($pdo);
            $codeimg = '../img/'.$type.'/'.$ref.'/'.$extension;
            if (!file_exists('../../img/'.$type.'/'.$ref)) {
            mkdir('../../img/'.$type.'/'.$ref, 0777, true);       
            move_uploaded_file($_FILES['monfichier']['tmp_name'][$i], '../../img/'.$type.'/'.$ref.'/'.$_FILES['monfichier']['name'][$i]); 
            }
            else{
            move_uploaded_file($_FILES['monfichier']['tmp_name'][$i], '../../img/'.$type.'/'.$ref.'/'.$_FILES['monfichier']['name'][$i]);
            }
            ajouterImage($pdo, $id+1, $ref,$codeimg);
        }
        
        
    }
    
    else{
        $erreur = 'Image non chargée';
    }
}
}

header('Location: ajoutBien.php');
