<?php

function connexionBDD() {
    $bdd = 'mysql:host=localhost;dbname=vizimmo';
    $user = 'APMission3';
    $password = 'VIZImmo';
    try {
        $ObjConnexion = new PDO($bdd, $user, $password, array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOException $e) {

        echo $e->getMessage();
    }return $ObjConnexion;
}

function deconnexionBDD($cnx) {
    $cnx = null;
}
function donneLesTypesDeBiens($pdo){
    $monObjPdoStatement=$pdo->prepare("Select id, libelle From typebien");
    $executionOK = $monObjPdoStatement->execute();
    $lesTypes = $monObjPdoStatement->fetchAll();
    $monObjPdoStatement->closeCursor();
    return $lesTypes;
}
function testRef($pdo, $ref){
     $monObjPdoStatement=$pdo->prepare("SELECT count(ref) FROM bien WHERE ref= :ref GROUP BY ref");
     $bvc1=$monObjPdoStatement->bindValue(':ref',$ref);
     $executionOK = $monObjPdoStatement->execute();
     $refChoisis = $monObjPdoStatement->fetch();
     if($refChoisis[0]!=0){
         $refOk = false;
     }else{
         $refOk = true;
     }
     return $refOk;
}

function verifieAuthentification($lePdo,$login,$mdp){
    $verifier=false;
    //$mdp= password_hash($mdp,PASSWORD_DEFAULT);
    $sth=$lePdo->prepare("SELECT mdp from utilisateur WHERE login = :login");
    
    $bvc3=$sth->bindValue(':login',$login,PDO::PARAM_STR);
    if($sth->execute()==1){
        $empreinte=$sth->fetch();
        if(password_verify($mdp, $empreinte['mdp'])){
            $verifier=true;
        }
    }
    return $verifier;
}
function recupTailleMax($lePdo,$nomTable,$nomColonne){
    $sto=$lePdo->prepare("SELECT `COLUMN_NAME`, `CHARACTER_MAXIMUM_LENGTH` FROM "
            . "`information_schema`.`COLUMNS` $nomTable WHERE COLUMN_NAME IN('$nomColonne')");
    $sto->execute();
    $empreinte=$sto->fetch();
    $taille=$empreinte['CHARACTER_MAXIMUM_LENGTH'];
    return $taille;
                
}

function donneLesBiens($pdo){
    $pdoStat = $pdo->prepare('SELECT bien.ref,bien.rue,bien.ville,bien.cp,'
            . 'typebien.libelle,bien.prix, bien.jardin, bien.surface, bien.nbpiece '
            . 'FROM bien JOIN typebien ON bien.type = typebien.id '
            . 'ORDER BY ref');
    $executeIsOk = $pdoStat->execute();
    $affichage = $pdoStat->fetchAll();
    return($affichage);
}

function ajouterBien($pdo, $ref, $rue, $cp, $ville, $prix, $type){
    $monObjPdoStatement=$pdo->prepare("INSERT INTO bien (ref,rue,cp,ville,prix,type) VALUES (:ref,:rue,:cp,"
            . ":ville,:prix,:type)");
    $bvc1=$monObjPdoStatement->bindValue(':ref',$ref);
    $bvc2=$monObjPdoStatement->bindValue(':rue',$rue);
    $bvc3=$monObjPdoStatement->bindValue(':cp',$cp);
    $bvc4=$monObjPdoStatement->bindValue(':ville',$ville);
    $bvc5=$monObjPdoStatement->bindValue(':prix',$prix);
    $bvc6=$monObjPdoStatement->bindValue(':type',$type);
    $execution=$monObjPdoStatement->execute();
    return $execution;
}

function modifierBien($pdo, $rue, $cp, $ville, $prix, $type,$jardin,$surface,$nbpiece, $ref){
    $monObjPdoStatement=$pdo->prepare("UPDATE bien SET rue=:rue, cp=:cp, "
            . "ville=:ville, prix=:prix, type=:type, jardin=:jardin, surface=:surface, nbpiece=:nbpiece WHERE ref=:ref");
    $bvc1=$monObjPdoStatement->bindValue(':rue',$rue);
    $bvc2=$monObjPdoStatement->bindValue(':cp',$cp);
    $bvc3=$monObjPdoStatement->bindValue(':ville',$ville);
    $bvc4=$monObjPdoStatement->bindValue(':prix',$prix);
    $bvc5=$monObjPdoStatement->bindValue(':type',$type);
    $bvc6=$monObjPdoStatement->bindValue(':jardin',$jardin);
    $bvc7=$monObjPdoStatement->bindValue(':surface',$surface);
    $bvc8=$monObjPdoStatement->bindValue(':nbpiece',$nbpiece);
    $bvc9=$monObjPdoStatement->bindValue(':ref',$ref);
    $execution=$monObjPdoStatement->execute();
    return $execution;
}

function donneLesRefs($pdo){
    $monObjPdoStatement=$pdo->prepare("Select ref From bien ORDER BY ref");
    $executionOK = $monObjPdoStatement->execute();
    $lesRefs = $monObjPdoStatement->fetchAll();
    $monObjPdoStatement->closeCursor();
    return $lesRefs;
}
function donneLeBien($pdo , $ref){
    $monObjPdoStatement=$pdo->prepare('SELECT ref,rue,ville,cp,prix,typebien.libelle,type,jardin,surface,nbpiece '
            . 'FROM bien JOIN typebien ON bien.type = typebien.id WHERE ref=:ref');
    $bvc1=$monObjPdoStatement->bindValue(':ref',$ref);
    $execution = $monObjPdoStatement->execute();
    $leBien = $monObjPdoStatement->fetch();
    $monObjPdoStatement->closeCursor();
    return $leBien;       
}
function rechercheBien($pdo,$typeBien,$budget,$surface,$nbPiece,$jardin,$ville){
    $requete='SELECT ref,ville,prix FROM bien JOIN typebien ON type=id';
    $compteurAnd=false;
    if($typeBien !="-" ||$budget!="-" || $surface!="-" || $nbPiece!="-" || $jardin!="-" || $ville!="-"){
        $requete.=" WHERE";
        if($typeBien != "-"){
            $requete.=' type=:type';
            $compteurAnd=true;
        }
        if($budget !="-"){
            if($compteurAnd){ 
                $requete.=" AND";
            }
            if($budget==1){
                $requete.=' prix<180000';
            }
            if($budget==2){
                $requete.=' prix>=180000 AND prix<250000 ';
            }
            if($budget==3){
                $requete.=' prix>=250000 AND prix<350000';
            }
            if($budget==4){
                $requete.=' prix>=350000';
            }
            $compteurAnd=true;
        }
        if($surface !="-"){
            if($compteurAnd){ 
                $requete.=" AND";
            }
            if($surface==1){
                $requete.=' surface<=50';
            }
            if($surface==2){
                $requete.=' surface<=100';
            }
            if($surface==3){
                $requete.=' surface<=200';
            }
            if($surface==4){
                $requete.=' surface>200';
            }
            $compteurAnd=true;
            
            
        }
        if($nbPiece !="-"){
            if($compteurAnd){ 
                $requete.=" AND";
            }
            if($nbPiece==1){
                $requete.=' nbpiece<=2';
            }
            if($nbPiece==2){
                $requete.=' nbpiece<=4';
            }
            if($nbPiece==3){
                $requete.=' nbpiece<=6';
            }
            if($nbPiece==4){
                $requete.=' nbpiece>6';
            }
            $compteurAnd=true;
            
        }
        if($jardin!="-"){
             if($compteurAnd){ 
                $requete.=" AND";
            }
            if($jardin==1){
                $requete.=" jardin=1";
            }
            if($jardin==2){
                $requete.=" jardin=0";
            }
            $compteurAnd=true;
            
        }
        if($ville!="-"){
            if($compteurAnd){
                $requete.=" AND";
            }
            if($ville==1){
                $requete.=" ville='Croix'";
            }
            if($ville==2){
                $requete.=" ville='Haveluy'";
            }
            if($ville==3){
                $requete.=" ville='Hem'";
            }
            if($ville==4){
                $requete.=" ville='Leers'";
            }
            if($ville==5){
                $requete.=" ville='Lille'";
            }
            if($ville==6){
                $requete.=" ville='Roubaix'";
            }
            if($ville==7){
                $requete.=" ville='Templeuve'";
            }
            if($ville==8){
                $requete.=" ville='Toufflers'";
            }
            if($ville==9){
                $requete.=" ville='Tourcoing''";
            }
            if($ville==10){
                $requete.=" ville='Trith Saint Leger'";
            }
            if($ville==11){
                $requete.=" ville='Wargnies le petit''";
            }
            if($ville==12){
                $requete.=" ville='Wattrelos'";
            }
        }
        
    }
    $pdoStat=$pdo->prepare($requete);
    $bvc=$pdoStat->bindValue(':type',$typeBien,PDO::PARAM_STR);
    $pdoStat->execute();
    $affichage = $pdoStat-> fetchAll();
    return $affichage;
}

function donneLesImages($pdo, $ref){
    
    $monObjPdoStatement=$pdo->prepare('SELECT id,codeimg FROM images WHERE ref=:ref');
    $bvc1=$monObjPdoStatement->bindValue(':ref',$ref);
    $execution = $monObjPdoStatement->execute();
    $image = $monObjPdoStatement->fetchAll();
    $monObjPdoStatement->closeCursor();
    
    return $image;
}

// A EXECUTER EN PREMIER
function supprimerImages($pdo,$ref){
    $monObjPdoStatement=$pdo->prepare('DELETE FROM images WHERE ref=:ref');
    $bvc1=$monObjPdoStatement->bindValue(':ref',$ref);
    $execution=$monObjPdoStatement->execute();
    return $execution;
}

// A EXECUTER EN SECOND
function supprimerBien($pdo,$ref){
    $monObjPdoStatement=$pdo->prepare('DELETE FROM bien WHERE ref=:ref');
    $bvc1=$monObjPdoStatement->bindValue(':ref',$ref);
    $execution=$monObjPdoStatement->execute();
    return $execution;
}

function ajouterImage($pdo, $id, $ref, $codeimg){
    $monObjPdoStatement=$pdo->prepare("INSERT INTO images VALUES (:id,:ref,:codeimg)");
    $bvc1=$monObjPdoStatement->bindValue(':id',$id);
    $bvc2=$monObjPdoStatement->bindValue(':ref',$ref);
    $bvc3=$monObjPdoStatement->bindValue(':codeimg',$codeimg);
    $execution=$monObjPdoStatement->execute();
    return $execution;
}

function getIdImage($pdo){
    $monObjPdoStatement=$pdo->prepare('SELECT MAX(id) FROM images');
    $execution = $monObjPdoStatement->execute();
    $id = $monObjPdoStatement->fetch();
    $monObjPdoStatement->closeCursor();
    return $id[0];
}

function supprimerUneImage($pdo,$id){
    $monObjPdoStatement=$pdo->prepare('DELETE FROM images WHERE id=:id');
    $bvc1=$monObjPdoStatement->bindValue(':id',$id);
    $execution=$monObjPdoStatement->execute();
    return $execution;
}

function donneUneImage($pdo,$id){
    $monObjPdoStatement=$pdo->prepare('SELECT codeimg FROM images WHERE id=:id');
    $bvc1=$monObjPdoStatement->bindValue(':id',$id);
    $execution = $monObjPdoStatement->execute();
    $image = $monObjPdoStatement->fetch();
    $monObjPdoStatement->closeCursor();
    return $image;
}

function ajouterUneStat($pdo,$id, $ville, $date){
    $monObjPdoStatement=$pdo->prepare("INSERT INTO statistiques VALUES (:id,:ville,:date)");
    $bvc1=$monObjPdoStatement->bindValue(':id',$id);
    $bvc2=$monObjPdoStatement->bindValue(':ville',$ville);
    $bvc3=$monObjPdoStatement->bindValue(':date',$date);
    $execution=$monObjPdoStatement->execute();
    return $execution;
}

function getIdStats($pdo){
    $monObjPdoStatement=$pdo->prepare('SELECT MAX(id) FROM statistiques');
    $execution = $monObjPdoStatement->execute();
    $id = $monObjPdoStatement->fetch();
    $monObjPdoStatement->closeCursor();
    return $id[0];
}

function donneLesVilles($pdo){
    $monObjPdoStatement=$pdo->prepare("Select ville From bien GROUP BY ville ");
    $executionOK = $monObjPdoStatement->execute();
    $lesVilles = $monObjPdoStatement->fetchAll();
    $monObjPdoStatement->closeCursor();
    return $lesVilles;
}

function donneLesStats($pdo,$ville){
    $monObjPdoStatement=$pdo->prepare('SELECT COUNT(ville) as nb FROM statistiques WHERE ville=:ville ');
    $bvc1=$monObjPdoStatement->bindValue(':ville',$ville);
    $execution = $monObjPdoStatement->execute();
    $Stat = $monObjPdoStatement->fetch();
    $monObjPdoStatement->closeCursor();
    return $Stat;
}

