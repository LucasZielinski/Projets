<?php 
session_start();
include_once '../../modeles/mesFonctionsAccesAuxDonnees.php';
$biens= donneLesBiens(connexionBDD());
?>
<html lang="fr">
    <head>
        <title> Liste des biens </title>
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
             include ('../../inc/menuVueAgent.inc');
            }
            else {
                include ('../../inc/menuVue.inc');
            }
            ?>
            <div class ="container-fluid">
                <div class="row">
                    <div class="col">
                        <h2>Statistiques des recherches VIZImmo !</h2>
                        <br/>
                        <li>
                        Saisissez la ville :  
                        </li>
                        <br/>                        
                    </div>
                </div>
                <form action="voirLesStatistiques.php" method="get">
                    <div>
                        <label for="ref">Reference :</label>
                        <Select id="ref" title="Choisissez la ville" name="lesVilles" required="">
                        <?php                            
                            $lesVilles = donneLesVilles(connexionBDD());
                            foreach($lesVilles as $uneVille){
                                echo '<option value="'.$uneVille['ville'].'">'.$uneVille[ville].'</option>';
                            }
                        ?>
                        </select>
                    </div>
                    <div class="button">
                        <button type="submit">Valider la ville</button>
                    </div>
            </div>
        <?php include ('../../inc/piedpage.inc'); ?>
        </section>
    </body>
    
</html>

