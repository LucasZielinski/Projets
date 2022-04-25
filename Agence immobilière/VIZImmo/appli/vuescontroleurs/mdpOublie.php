<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="verificationMdp.php" method="POST">
                <h1>Réinitialiser votre mot de passe</h1>
                <div>
                    <label><b>Adresse Mail</b></label>
                    <input type="email" placeholder="Entrer votre adresse mail" name="recup_mail">
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