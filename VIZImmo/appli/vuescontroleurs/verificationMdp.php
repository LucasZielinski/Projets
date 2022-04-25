<?php
session_start();
include_once '../modeles/mesFonctionsAccesAuxDonnees.php';
$bdd= connexionBDD();

if(isset($_GET['section'])){
    $section= htmlspecialchars($_GET['section']);
    if($section=='code'){ ?>
<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="changementMdp.php" method="POST">
                <h1>Réinitialiser votre mot de passe</h1>
                <div>
                    <label><b>Code de vérification</b></label>
                    <input type="text" placeholder="Entrer votre code de vérification" name="code">
                </div>
                <div>
                    <label><b>Nouveau Mot de passe</b></label>
                    <input type="text" placeholder="Entrer votre nouveau mot de passe" name="newMdp">
                </div>
                <div class="button">
                        <button type="submit" name="recup_submit">Réinitialiser le mot de passe</button>
                </div>
                <?php
                
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2){
                        echo "<p style='color:red'>Email Incorrect</p>";
                }
                }
                ?>
                
            </form>
        </div>
        
    </body>
</html>

 <?php          
    }
         
}
else {
    $section="";
}


if(isset($_POST['recup_submit'],$_POST['recup_mail'])){
    if(!empty($_POST['recup_mail'])){
        
        $recup_mail= htmlspecialchars($_POST['recup_mail']);
        if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)){
            $mailexist=$bdd->prepare('SELECT id FROM utilisateur WHERE mail = ?');
            $mailexist->execute(array($recup_mail));
            $mailexist=$mailexist->rowCount();
            if($mailexist==1){
                 $_SESSION['recup_mail']= $recup_mail;
                 $recup_code ="";
                 for($i=0; $i < 8; $i++){
                     $recup_code.=mt_rand(0,9);
                 }
                 $_SESSION['recup_code']=$recup_code;

                 $mail_recup_exist=$bdd->prepare('SELECT id FROM recuperation WHERE mail= ?');
                 $mail_recup_exist->execute(array($recup_mail));
                 $mail_recup_exist=$mail_recup_exist->rowCount();
                 if ($mail_recup_exist==1) {
                     $recup_insert = $bdd->prepare('UPDATE recuperation SET code = ? WHERE mail= ?');
                 $recup_insert->execute(array($recup_code,$recup_mail));
                     }
                 else{
                     $recup_insert = $bdd->prepare('INSERT INTO recuperation(mail,code) VALUES (?, ?)');
                     $recup_insert->execute(array($recup_mail,$recup_code));
                     
                 }
                 $header="MIME-Version: 1.0\r\n";
         $header.='From:"[VOUS]"<verriestjordan@gmail.com>'."\n";
         $header.='Content-Type:text/html; charset="utf-8"'."\n";
         $header.='Content-Transfer-Encoding: 8bit';
         $message = '
         <html>
         <head>
           <title>Récupération de mot de passe - Votresite</title>
           <meta charset="utf-8" />
         </head>
         <body>
           <font color="#303030";>
             <div align="center">
               <table width="600px">
                 <tr>
                   <td>
                     
                     <div align="center">Bonjour</div>
                     Voici votre code de récupération: <b>'.$recup_code.'</b>
                     A bientôt sur <a href="#">VizImmo</a> !
                     
                   </td>
                 </tr>
                 <tr>
                   <td align="center">
                     <font size="2">
                       Ceci est un email automatique, merci de ne pas y répondre
                     </font>
                   </td>
                 </tr>
               </table>
             </div>
           </font>
         </body>
         </html>
         ';
         mail($recup_mail, "Récupération de mot de passe - Votresite", $message, $header);
            header("Location:http://192.168.0.30/VIZImmo/appli/vuescontroleurs/verificationMdp.php?section=code&code=.$recup_code.");
                 
                 
                 
            }
            else{
                echo "Cette adresse mail n'existe pas !";
            }
            
        }
    }
    else{
        echo "Veuillez entrer une adresse mail";
    }
}

