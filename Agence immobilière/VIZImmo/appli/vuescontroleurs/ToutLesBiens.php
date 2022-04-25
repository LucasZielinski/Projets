<?php 
session_start();
include_once '../modeles/mesFonctionsAccesAuxDonnees.php';
$biens= donneLesBiens(connexionBDD());
?>
<html lang="fr">
    <head>
        <title> Liste des biens </title>
        <meta charset="UTF-8">  
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" 
              rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" 
              crossorigin="anonymous">
    </head>
    <body>
        <section>
      <?php include ('../inc/entete.inc'); ?>
        <?php
         if (isset($_SESSION['username'])) {
             include ('../inc/menuVueAgent.inc');
            }
            else {
                include ('../inc/menuVue.inc');
            }
            ?>
        <h1>Liste des biens</h1>
        <div class ="container-fluid">
            <?php foreach ($biens as $bien):?>            
            <div class ="container-fluid">
               <li> 
                   <a href="bien.php?id=<?=$bien['ref']?>"><?= $bien['libelle'] ?> situé <?= $bien['rue'] ?>
                   à <?= $bien['ville'] ?> au prix de <?= $bien['prix'] ?> € de référence <?= $bien['ref'] ?> </a>
               </li>
               <br> </br>
            </div>                                      
            <?php endforeach;?>            
        </div>
        <?php include ('../inc/piedpage.inc'); ?>
        </section>
    </body>
    
</html>

