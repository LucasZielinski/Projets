<?php 
session_start();
?>
<html class="html" lang="fr">
    <head>
        <title>VIZIMMO Contact</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
        }else {
            include ('../inc/menuVue.inc');
        }?>
            <div class ="container-fluid">
                <h1><u> Contact </u></h1>
                <div class="text-center">
                    <img class="rounded img-fluid" src="../img/contact.png" alt="photo contact" 
                         height="150" width="500"/>
                </div>
                <div class="text-center">
                    <h3><em> Rencontrez-nous en agence dès maintenant ! </em></h3>
                    <div class="intro">
                        <p>
                             agence est située au 67 rue du marechal Leclerc à 
                             Lys-Lez-Lannoy (59390) à 5min de la mairie
                        </p>
                    </div>
                    <div class="contact">
                        <p>
                             N° de téléphone : 03.20.25.40.75 
                            <br/>
                             Adresse e-mail : 
                            <a class="mail" href="VIZImmo@gmail.com">VIZImmo@gmail.com</a>
                            <
                        </p>
                    </div>
                    <h3><u> Nos horaires </u></h3>
                    <p>
                        <u>
                            <b> Lundi </b>
                        </u>
                    </p>
                    <p>
                         de 8h à 12h et 14h à 17h 
                    </p>
                    <p>
                        <u>
                            <b> Mardi </b>
                        </u>
                    </p>
                    <p>
                         de 8h à 12h et 14h à 16h30 
                    </p>
                    <p>
                        <u>
                            <b> Mercredi </b>
                        </u>
                    </p>
                    <p>
                         de 8h à 12h et 14h à 17h 
                    </p>
                    <p>
                        <u>
                            <b> Jeudi </b>
                        </u>
                    </p>
                    <p>
                         de 8h à 12h et 14h à 17h 
                    </p>
                    <p>
                        <u>
                            <b> Vendredi </b>
                        </u>
                    </p>
                    <p>
                         de 8h à 12h et 14h à 18h 
                    </p>
                    <p>
                        <u>
                            <b> Samedi </b>
                        </u>
                    </p>
                    <p>
                         de 8h30 à 11h30
                    </p>
                </div>
            </div>
        </section>
        <?php include ('../inc/piedpage.inc'); ?>
    </body>
</html>