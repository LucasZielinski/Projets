<?php 
session_start();
include_once '../../modeles/mesFonctionsAccesAuxDonnees.php';
?>
<html class="html" lang="fr">
    <head>
        <title> VIZIMMO Statistiques </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" 
              rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" 
              crossorigin="anonymous">
    </head>
    <body>
        <section>
        <?php include ('../../inc/entete.inc'); ?>
        <?php
        if (isset($_SESSION['username'])) {
            include ('../../inc/menuFonctionnalitesAgent.inc');
        }else {
            include ('../../inc/menuIndex.inc');
        }?>
            <div class ="container-fluid">
                <div class="row">
                    <div class="col">
                        <h2>Statistiques des recherches VIZImmo !</h2>
                        <br/>
                        <p>Vous avez saisi la ville de <?php echo $_GET['lesVilles'] ?> </p>                       
                        <br/>  
                        <p> Voici les statistiques : </p>
                        <br/>
                    </div>
                </div>
               
                <?php                
                $lesStats= donneLesStats(connexionBDD(),$_GET['lesVilles']);              
                $uneStat = $lesStats;?>
                <li> <?php echo 'Il y a en tout '.$uneStat['nb'].' recherches qui ont été effectué pour la ville de '.$_GET['lesVilles'];?> </li>
                <?php ?>
                

               
            </div>
        </section>
        <?php include ('../../inc/piedpage.inc'); ?>
    </body>
</html>