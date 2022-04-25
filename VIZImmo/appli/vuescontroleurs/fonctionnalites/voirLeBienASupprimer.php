<?php 
session_start();
?>
<html class="html" lang="fr">
    <head>
        <title> VIZIMMO supprimer Bien </title>
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
                        <h2>Supprimez un bien dans VIZImmo !</h2>
                        <br/>
                        Voici les informations du bien que vous avez choisis :
                        <br/>
                        <ul>
                            <li> La rue du bien, qui y renseigne le numéro de rue 
                                ainsi que la rue où se situe le bien.</li>
                            <li> La ville où se situe le bien.</li>
                            <li> Le code postale de la ville où se situe le bien.</li>
                            <li> Le prix du bien en euros (€).</li>
                            <li> Le type du bien, allant de 1 à 5 :</li>
                            <ul>
                                <li> Le numéro 1 pour un Appartement</li>
                                <li> Le numéro 2 pour un Immeuble</li>
                                <li> Le numéro 3 pour un local</li>
                                <li> Le numéro 4 pour une maison</li>
                                <li> Le numéro 5 pour un terrain</li>
                            </ul>
                            <li> Si le bien possède ou non un jardin </li>
                            <li> La surface en m² du bien concerné </li>
                            <li> Le nombre de pièce que contient le bien </li>
                            <li> Les images de ce bien.</li>
                        </ul>
                    </div>
                </div>
               
                <?php
                include_once '../../modeles/mesFonctionsAccesAuxDonnees.php';
                $leBien= donneLeBien(connexionBDD(),$_POST['lesRefs']);
                ?>

                <form name="suppression" onsubmit="return confirm('Êtes-vous sûre de supprimer ce bien ?');"
                    action="controleSaisiSupprimer.php?ref = $_POST['lesRefs']" method="post">
                    <div>
                        <label for="ref">Ref :</label>
                        <input type="text" id="ref" name="ref" readonly="readonly" 
                               required="" value="<?php echo $leBien['ref']; ?>" >
                    </div>
                    <div>
                        <label for="rue">Rue :</label>
                        <input type="text" id="rue" name="rue" readonly="readonly" 
                               required="" value="<?php echo $leBien['rue']; ?>" >
                    </div>
                    <div>
                        <label for="ville">Ville :</label>
                        <input type="text" id="ville" name="ville" readonly="readonly" 
                               required="" value="<?php echo $leBien['ville']; ?>" >
                    </div>
                    <div>
                        <label for="cp">Code Postal :</label>
                        <input type="text" id="cp" name="cp" readonly="readonly" 
                               required="" value="<?php echo $leBien['cp']; ?>" >
                    </div>
                    <div>
                        <label for="prix">Prix :</label>
                        <input type="text" id="prix" name="prix" readonly="readonly" 
                               required="" value="<?php echo $leBien['prix']; ?>" >
                    </div>
                    <div>
                        <label for="type">Type de bien : </label>
                        <input type="text" id="type" name="type" readonly="readonly" 
                               required="" value="<?php echo $leBien['libelle']; ?>" >
                    </div>
                    <div>
                        <label for="jardin">Jardin :</label>
                        <input type="text" id="jardin" name="jardin" readonly="readonly" 
                               required="" value="
                                   <?php 
                                    if ($leBien['jardin']==1){
                                        echo 'Oui'; 
                                    }else{
                                        echo 'Non';
                                    }
                                    ?>" >
                                    
                    </div>
                    <div>
                        <label for="surface">Surface :</label>
                        <input type="text" id="surface" name="surface" readonly="readonly" 
                               required="" value="<?php echo $leBien['surface']; ?>" >
                    </div>
                    <div>
                        <label for="nbpiece">Nombre de pièces :</label>
                        <input type="text" id="nbpiece" name="nbpiece" readonly="readonly" 
                               required="" value="<?php echo $leBien['nbpiece']; ?>" >
                    </div>
                    <div>
                        <label for="images">Images :</label>
                            <?php
                            $lesImages = donneLesImages(connexionBDD(),$_POST['lesRefs']);
                            $DesImages = "";
                            foreach($lesImages as $image){
                                $DesImages =$DesImages.'"../'.$image['codeimg'].'", ';
                            }
                            ?>
                        <script>
                            var tableauImage = new Array(<?=$DesImages?>); 
                            var numero = 0;
                            function ChangeSlide(sens){
                                numero = numero + sens;
                                if (numero<0)
                                    numero = tableauImage.length -1;
                                if (numero > tableauImage.length -1)
                                    numero = 0;
                                document.getElementById("defiler").src = tableauImage[numero];
                            }
                            setInterval("ChangeSlide(1)",10000);                        
                        </script>
                
                        <div class="container-fluid">
                            <img class="taille_image_formulaire" src="../<?=$image['codeimg']?>" 
                                 alt="Photo du bien" id="defiler"/>
                        </div>
               
                        <div class="les_fleches_formulaire">
                            <img src="../../img/fleche-gauche.jpg" onclick="ChangeSlide(-1)" 
                                 alt="fleche vers la gauche" height="100" width="100"/>
                            <img src="../../img/fleche-droite.jpg" onclick="ChangeSlide(1)" 
                                 alt="fleche vers la droite" height="100" width="100"/>
                        </div>
                    </div>
                    <div class="button">
                        <button type="submit">Valider la suppression du bien</button>
                    </div>
                </form>
            </div>
        </section>
        <?php include ('../../inc/piedpage.inc'); ?>
    </body>
</html>