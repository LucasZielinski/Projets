<?php 
session_start();
?>

<html class="html" lang="fr">
    <head>
        <title> VIZIMMO Ajout Bien </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
                        <h2>Ajoutez de nouveaux biens dans VIZImmo !</h2>
                        <br/>
                        Pour ajouter un nouveau bien dans notre nouvelle base de donnée, il vous faut y renseigner :  
                        <br/>
                        <ul>
                            <li> La référence du bien, par exemple si c'est le local n°15, la référence serait L15.</li>
                            <li> La rue du bien, qui y renseigne le numéro de la rue ainsi que la rue où se situe le bien.</li>
                            <li> Le code postale de la ville où se situe le bien.</li>
                            <li> La ville où se situe le bien.</li>
                            <li> Le prix du bien en euros (€).</li>
                            <li> Le type du bien, allant de 1 à 5 :</li>
                            <ul>
                                <li> Le numéro 1 pour un Appartement</li>
                                <li> Le numéro 2 pour un Immeuble</li>
                                <li> Le numéro 3 pour un local</li>
                                <li> Le numéro 4 pour une maison</li>
                                <li> Le numéro 5 pour un terrain</li>
                            </ul>
                        </ul>
                    </div>
                </div>
                <form action="controleSaisiAjout.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="ref">Reference :</label>
                        <input type="text" id="reference" name="reference" >
                    </div>
                    <div>
                        <label for="rue">Rue :</label>
                        <input type="text" id="rue" name="rue" >
                    </div>
                    <div>
                        <label for="cp">Code Postal :</label>
                        <input type="text" id="cp" name="cp" >
                    </div>
                    <div>
                        <label for="ville">Ville :</label>
                        <input type="text" id="ville" name="ville">
                    </div>
                    <div>
                        <label for="prix">Prix :</label>
                        <input type="text" id="prix" name="prix" >
                    </div>
                    <div>
                        <label for="type">Type de bien : </label>
                        <select id="type" title="Choisissez votre type" name="lestypes" >
                            <?php
                                include_once '../../modeles/mesFonctionsAccesAuxDonnees.php';
                                $lesTypes = donneLesTypesDeBiens(connexionBDD());
                                foreach($lesTypes as $unType){
                                    echo '<option value="'.$unType['id'].'">'.$unType['libelle'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="jardin">Jardin :</label>
                        <select id="jardin" title="Choisissez s'il y'a ou non un jardin" 
                                name="lesjardins">
                            <option value="1">Il y a un jardin</option>
                            <option value="0">Il n'y a pas de jardin</option>
                        </select>
                    </div>
                    <div>
                        <label for="surface">Surface :</label>
                        <input type="text" id="surface" name="surface">
                    </div>
                    <div>
                        <label for="nbpiece">Nombre de pièces :</label>
                        <input type="text" id="nbpiece" name="nbpiece">
                    </div>
                    <div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                        <input name="monfichier[]" type="file" multiple="multiple"/>
                    </div>
                    <div class="button">
                        <button type="submit" name="valider">Valider l'ajout du bien</button>
                    </div>
                </form>
            </div>
        </section>
        <?php include ('../../inc/piedpage.inc'); ?>
    </body>
</html>