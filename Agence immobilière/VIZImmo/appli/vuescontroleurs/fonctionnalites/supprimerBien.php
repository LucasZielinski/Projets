<?php 
session_start();
?>
<html class="html" lang="fr">
    <head>
        <title> VIZIMMO Supprimer Bien </title>
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
                        <h2>Supprimez des biens dans VIZImmo !</h2>
                        <br/>
                        Pour supprimer un bien dans notre nouvelle base de donnée, 
                        il vous faut d'abord saisir la référence :  
                        <br/>
                        <ul>
                            <li> A correspondant à Appartement </li>
                            <li> I correspondant à Immeuble </li>
                            <li> L correspondant à Local </li>
                            <li> M correspondant à Maison </li>
                            <li> T correspondant à Terrain </li>
                        </ul>
                    </div>
                </div>
                <form action="voirLeBienASupprimer.php" method="post">
                    <div>
                        <label for="ref">Reference :</label>
                        <Select id="ref" title="Choisissez la reference" name="lesRefs" required="">
                        <?php
                            include_once '../../modeles/mesFonctionsAccesAuxDonnees.php';
                            $lesRefs = donneLesRefs(connexionBDD());
                            foreach($lesRefs as $uneRef){
                                echo '<option value="'.$uneRef['ref'].'">'.$uneRef[ref].'</option>';
                            }
                        ?>
                        </select>
                    </div>
                    <div class="button">
                        <button type="submit">Valider la référence</button>
                    </div>
                </form>
            </div>
        </section>
        <?php include ('../../inc/piedpage.inc'); ?>
    </body>
</html>