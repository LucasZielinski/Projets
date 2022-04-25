<?php 
session_start();

?>
<html class="html" lang="fr">
    <head>
        <title> VIZIMMO Immobilier </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" 
              rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" 
              crossorigin="anonymous">
        
    </head>
    <body>
        <section>
            <?php include ('inc/entete.inc'); ?>
        <?php
         if (isset($_SESSION['username'])) {
             include ('inc/menuIndexAgent.inc');
            }
            else include ('inc/menuIndex.inc'); ?>
        
            <div class ="container-fluid">
                <div class="row ">
                    <div class="col-8">
                        <h2> Présentation de l'agence </h2>
                        <br/>
                        Bienvenue dans l'agence VIZImmo, une agence nouvelle, jeune et moderne, 
                        prête à vous accueillir et à vous trouver la future demeure de vos rêves !
                        <br/>
                        En effet, l'agence VIZImmo se situe au 67 rue du marechal Leclerc à Lys-Lez-Lannoy 
                        (59390), une ville moderne et jeune comme notre agence immobilière.
                        <br/>
                    </div>
                    <div class ="col">
                        <img class="rounded img-fluid" src="img/photo_blockquote.jpg" heigth="450" width="450" />
                    </div>
                </div>
            </div>
            <div class ="container-fluid">
                <div class="row">
                    <div class="col">
                        <h2> Liste des lieux de vente </h2>
                        <br/>
                        En effet, chez VIZImmo nous vendons vos futures demeures dans tout les Hauts-de-France.
                        <br/>
                        Les biens que nous présentons et vendons se situent tant bien à 
                        Leers qu'à Toufflers, Roubaix, Tourcoing, Wattrelos, Croix, Hem, 
                        et même à Templeuve, Trith Saint Leger, Haveluy et Wargnies le petit.
                        <br/>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h2> Liste des types de biens en vente </h2>
                        <br/>
                        Chez VIZImmo, plusieurs biens vous sont présentés : 
                        <br/>
                        <ul>
                            <li> 5 maisons pour tout les goûts.</li>
                            <li> 7 Appartements, de surfaces adaptées à vos besoins.</li>
                            <li> 3 locaux commerciaux, parfait pour débuter dans la vente 
                                ou conforter votre monopole financier.</li>
                            <li> 2 immeubles, de styles contemporain ou haussmannien, 
                                ils sont tous là pour vous satisfaire.</li>
                            <li> 4 terrains nus, des vastes, des hectares, quelques 
                                dixaines de m², idéal pour construire et bâtir votre nouvelle vie !</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php include ('inc/piedpage.inc'); ?>
    </body>
</html>