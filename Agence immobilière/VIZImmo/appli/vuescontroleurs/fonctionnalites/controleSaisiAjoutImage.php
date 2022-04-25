<?php

include_once '../modeles/mesFonctionsAccesAuxDonnees.php';

// Récupère les infos de l'image

$pdo = connexionBDD();

if(isset($_POST) && !empty($_POST)){   
    
    if($_FILES['monfichier']['error'] == 0){
        
        // test taille        
        if($_FILES['monfichier']['size'] > 500000){
           $erreur = 'Votre fichier est trop lourd';
        }
        
        // Extension
        
        // 
        
        if(!isset($erreur)){
            $ref= htmlspecialchars(trim($_POST['reference']));                  
            $extension = $_FILES['monfichier']['name'];
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
            $idMax = getId($pdo);
            foreach ($idMax as $id){
                $id = $idMax['id'];
            }
            $codeimg = '../img/'.$ref.'/'.$type.'/'.$extension;
            mkdir('../../img/'.$type.'/'.$ref, 0777, true);       
            move_uploaded_file($_FILES['monfichier']['tmp_name'], '../../img/'.$type.'/'.$ref.'/'.$_FILES['monfichier']['name']); 
            ajouterImage($pdo, $id, $ref,$codeimg);
            
        }
        
    }
    else{
        $erreur = 'Image non chargée';
    }
}



    
    

