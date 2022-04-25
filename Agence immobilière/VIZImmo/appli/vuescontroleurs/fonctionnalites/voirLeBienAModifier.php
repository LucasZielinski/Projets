<?php 
session_start();
?>
<html class="html" lang="fr">
    <head>
        <title> VIZIMMO Modifier Bien </title>
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
                        <h2>Modifiez des biens dans VIZImmo !</h2>
                        <br/>
                        Vous avez saisi la référence, maintenant, 
                        il vous suffit de renseigner plusieurs informations :  
                        <br/>
                        <ul>
                            <li> La nouvelle rue du bien, qui y renseigne le nouveau numéro de rue 
                                ainsi que la nouvelle rue où se situe le bien.</li>
                            <li> La nouvelle ville où se situe le bien.</li>
                            <li> Le nouveau code postale de la ville où se situe le bien.</li>
                            <li> Le nouveau prix du bien en euros (€).</li>
                            <li> Le nouveau type du bien, allant de 1 à 5 :</li>
                            <ul>
                                <li> Le numéro 1 pour un Appartement</li>
                                <li> Le numéro 2 pour un Immeuble</li>
                                <li> Le numéro 3 pour un local</li>
                                <li> Le numéro 4 pour une maison</li>
                                <li> Le numéro 5 pour un terrain</li>
                            </ul>
                            <li> Si le bien possède un nouveau jardin ou non </li>
                            <li> La nouvelle surface en m² du bien concerné </li>
                            <li> Le nouveau nombre de pièce que contient le bien </li>
                            <li> Les nouvelles photos du biens </li>
                        </ul>
                    </div>
                </div>
               
                <?php
                include_once '../../modeles/mesFonctionsAccesAuxDonnees.php';
                $leBien= donneLeBien(connexionBDD(),$_GET['lesRefs']);
                ?>

                <form name="modification" onsubmit="return confirm('Êtes-vous sûre de modifier ce bien ?');" 
                      action="controleSaisiModifier.php?ref = $_GET['lesRefs']" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="ref">Ref :</label>
                        <input type="text" id="ref" name="ref" readonly="readonly" required="" 
                               placeholder="Référence du bien" value="<?php echo $leBien['ref']; ?>" >
                    </div>
                    <div>
                        <label for="rue">Rue :</label>
                        <input type="text" id="rue" name="rue" required="" 
                               placeholder="Rue ainsi que le numéro" value="<?php echo $leBien['rue']; ?>" >
                    </div>
                    <div>
                        <label for="ville">Ville :</label>
                        <input type="text" id="ville" name="ville" required="" 
                               placeholder="Ville du bien" value="<?php echo $leBien['ville']; ?>" >
                    </div>
                    <div>
                        <label for="cp">Code Postal :</label>
                        <input type="text" id="cp" name="cp" required="" 
                               placeholder="Code postal du bien" value="<?php echo $leBien['cp']; ?>" >
                    </div>
                    <div>
                        <label for="prix">Prix :</label>
                        <input type="text" id="prix" name="prix" required="" 
                               placeholder="Prix du bien" value="<?php echo $leBien['prix']; ?>" >
                    </div>
                    <div>
                        <label for="type">Type de bien :</label>
                        <select id="type" title="Choisissez votre type" 
                                name="lestypes" required="">
                            <?php
                            $lesTypes = donneLesTypesDeBiens(connexionBDD());
                            foreach($lesTypes as $unType){
                                if($unType['id'] == $leBien['type']){
                                    echo '<option value="'.$unType['id'].'" selected >'
                                            . ''.$unType['libelle'].'</option>';
                                }
                                else{
                                    echo '<option value="'.$unType['id'].'">'.$unType['libelle'].''
                                            . '</option>';
                                }  
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="jardin">Jardin :</label>
                        <select id="jardin" title="Choisissez s'il y'a ou non un jardin" 
                                name="lesjardins" required="">
                            <option value="1">Il y a un jardin</option>
                            <option value="0">Il n'y a pas de jardin</option>
                        </select>
                    </div>
                    <div>
                        <label for="surface">Surface :</label>
                        <input type="text" id="surface" name="surface" required="" 
                               placeholder="Surface du bien en m²" value="<?php echo $leBien['surface']; ?>" >
                    </div>
                    <div>
                        <label for="nbpiece">Nombre de pièces :</label>
                        <input type="text" id="nbpiece" name="nbpiece" required="" 
                               placeholder="Nombre de pièces du bien" value="<?php echo $leBien['nbpiece']; ?>" >
                    </div>
                    <div>
                        <label for="images">Images :</label>
                            <?php
                            $lesImages = donneLesImages(connexionBDD(),$_GET['lesRefs']);
                            $DesImages = "";
                            foreach($lesImages as $image){
                                $DesImages =$DesImages.'"../'.$image['codeimg'].'", ';
                                $id=$image['id'];
                                echo '<img class="image_modifier" src="../'.$image['codeimg'].'" 
                                     alt="Photo des biens" value="'.$id.'" >
                                     <input name="supprimerUneImage"
                                     type="submit" value="Supprimer la photo n°'.$id.'"/>';
                            }
                            ?>
                    </div>
                    <div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                        <input name="nouvelleImage" type="file" multiple="multiple"/>
                    </div>
                    <div class="button">
                        <button type="submit">Valider la modification du bien</button>
                    </div>
                </form>
            </div>
        </section>
        <?php include ('../../inc/piedpage.inc'); ?>
    </body>
</html>