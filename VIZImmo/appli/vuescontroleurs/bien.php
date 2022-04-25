<?php 
include_once '../modeles/mesFonctionsAccesAuxDonnees.php';
session_start();


if (isset($_GET['id'])){ // on vérifie qu’un id est bien passé en GET (dans l’URL)
    $ref=$_GET['id']; 
    //echo "Affichage du bien d'identifiant $ref"; 
 }
 
$lePdo = connexionBDD();
$bien = donneLeBien($lePdo, $ref);
$images= donneLesImages($lePdo, $bien['ref']);

?>



<html class="html" lang="fr">
    <head>
        <title> VIZIMMO </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <script src="../../../js/pdf.js" defer></script> 
	<script src="../../../import/jspdf.js"></script>
	<script src="../../../import/addimage.js"></script>
	<script src="../../../import/FileSaver.js"></script>
    </head>
    
    <body>   
        
        <section> 
            
        <?php include ('../inc/entete.inc');?>
        <?php
        $jardin="et n'a pas de jardin";
        if($bien['jardin']==1){
            $jardin="et à un jardin";
        }
        
         if (isset($_SESSION['username'])) {
             include ('../inc/menuVueAgent.inc');
            }
            else {
                include ('../inc/menuVue.inc');
            }
            
            
            ?>                
               <h2> <?= $bien['libelle']?> à <?= $bien['ville']?> au prix de <?= $bien['prix']?>€ </h2>
                     <div class="container-fluid">                    
                        <li>
                        Le bien de référence <?= $bien['ref'] ?>, situé au <?= $bien['rue'] ?> 
                        à <?= $bien['ville'] ?> (<?= $bien['cp'] ?>)
                        fait <?= $bien['surface'] ?> m² , comporte <?= $bien['nbpiece'] ?> pièce(s) <?= $jardin ?>
                        
                            
                        
                        
                        
                        </li>                    
            </div>
          
               <?php 
               $lesImages = "";
               foreach($images as $image){              
               $lesImages =$lesImages.'"'.$image['codeimg'].'", ';
               }
               ?>
               
               <script>
		    var tableauImage = new Array(<?=$lesImages?>); 
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
            <img class="taille_image" src="<?=$image['codeimg']?>" alt="Photo du bien" id="defiler"/>
              </div>
               
            <div class="les_fleches">
                <img src="../img/fleche-gauche.jpg" onclick="ChangeSlide(-1)" alt="fleche vers la gauche" height="100" width="100"/>
                <img src="../img/fleche-droite.jpg" onclick="ChangeSlide(1)" alt="fleche vers la droite" height="100" width="100"/>
            </div>
                
        </section>    
        
	    <?php include ('../inc/piedpage.inc'); ?>
	</body>
</html>