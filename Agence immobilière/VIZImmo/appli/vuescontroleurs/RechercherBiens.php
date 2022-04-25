<?php 
session_start();
include_once '../modeles/mesFonctionsAccesAuxDonnees.php';
$_POST['AfficherLesBiens']=false;
?>
<!DOCTYPE html>
<html class="html" lang="fr">
    <head>
        <title> VIZIMMO Rechercher Bien</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
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
            <h1>Rechercher un bien : </h1>
            <br/>
            <div class ="container-fluid">
                <div class="row">
                    <div class="col">
                        <h2>Bienvenu dans la page de la recherche de Bien de VIZImmo ! </h2><br/>
                        Cette page vous offre plusieurs choix possibles afin de filtrer vos recherche de biens ! <br/>
                        En effet vous pouvez choisir : 
                        <ul>
                            <li> Saisir un type de Bien entre Appartement, Immeuble, Local, Maison, Terrain </li>
                            <li> Une tranche de prix : </li>
                            <ul>
                                <li> De 0 à 180 000 euros </li>
                                <li> De 180 000 à 250 000 euros </li>
                                <li> De 250 000 à 350 000 euros </li>
                                <li> De 350 000 à 999 999 999 euros </li>
                            </ul>
                            <li> Saisir la surface maximum du bien en m² : </li>
                            <ul>
                                <li> De 0 à 50 m² </li>
                                <li> De 51 à 100 m² </li>
                                <li> De 101 à 200 m² </li>
                                <li> De plus de 200 m² </li>
                            </ul>
                            <li> Saisir le nombre de pièces au maximum : </li>
                            <ul>
                                <li> 2 pièces au maximum </li>
                                <li> 4 pièces au maximum </li>
                                <li> 6 pièces au maximum </li>
                                <li> Plus de 6 pièces au maximum </li>
                            </ul>
                            <li> Saisir s'il y a un jardin ou non </li>
                        </ul>
                    </div>
                </div>
                <form method="post" action="RechercherBiens.php">
                <div>
                        <label for="type">Type de bien : </label>
                            <select id="selectType" title="Choisissez votre type" name="lesTypes" required="">
                                <option value="-"> Tous les types  </option>
                                <?php
                                    include_once '../modeles/mesFonctionsAccesAuxDonnees.php';
                                    $lesTypes = donneLesTypesDeBiens(connexionBDD());
                                    foreach($lesTypes as $unType){
                                        echo '<option value="'.$unType['id'].'">'.$unType['libelle'].'</option>';
                                    }?>
                            </select>
                    </div>
                    <div>
                        <label for="prix">Prix du bien : </label>
                        <select id="selectBudget" title="Choisissez votre budget" name="leBudget" required="">
                            <option value="-">Indifférent</option>
                            <option value="1">Moins de 180 000€</option>
                            <option value="2">De 180 à 250 000€</option>
                            <option value="3">De 250 à 350 000€</option>
                            <option value="4">+ de 350 000€</option>
                        </select>
                    </div>
                   
                    <div>
                        <label for="surface">Surface en m²: </label>
                        <select id="selectSurface" title="Choisissez votre surface" name="laSurface" required="">
                            <option value="-">Indifférent</option>
                            <option value="1">Entre 0 et 50 m²</option>
                            <option value="2">Entre 51 et 100m²</option>
                            <option value="3">Entre 101 et 200 m²</option>
                            <option value="4">Plus de 200m²</option>
                            
                        </select>
                    </div>
                    <div>
                        <label for="nbPiece">Nombre de pièces maximum</label>
                        <select id="selectNbPiece" title="Choisissez votre nombre de pièces" name="leNbPiece" required="">
                            <option value="-">Indifférent</option>
                            <option value="1">2</option>
                            <option value="2">4</option>
                            <option value="3">6</option>
                            <option value="4">Plus de 6</option>
                            
                        </select>
                    </div>
                    <div>
                        <label for="jardin">Jardin : </label>
                         <select id="selectJardin" title="Choisissez si vous voulez un Jardin" name="Jardin" required="">
                            <option value="-">Indifférent</option>
                            <option value="1">Oui</option>
                            <option value="2">Non</option>
                        </select>
                         
                    </div>
                    <div>
                        <label for="ville">Ville : </label>
                        <select id="selectVille" title="Choisissez votre ville" name="laVille" required="">
                            <option value="-">Indifférent</option>
                            <option value="1">Croix</option>
                            <option value="2">Haveluy</option>
                            <option value="3">Hem</option>
                            <option value="4">Leers</option>
                            <option value="5">Lille(Champion)</option>
                            <option value="6">Roubaix</option>
                            <option value="7">Templeuve</option>
                            <option value="8">Toufflers</option>
                            <option value="9">Tourcoing</option>
                            <option value="10">Trith-Saint-Leger</option>
                            <option value="11">Wargnies le petit</option>
                            <option value="12">Wattrelos</option>
                            
                            
                            
                        </select>
                    </div>
            
                
                        <br/>
                        <div class="button">
                        <button type="submit">Valider la recherche</button>
                    </div>
                         
        
                    <?php
                if (isset($_POST['lesTypes'])|| isset($_POST['leBudget'])|| isset($_POST['laSurface'])|| isset($_POST['leNbPiece'])||isset($_POST['Jardin'])){
                    $affichages= rechercheBien(connexionBDD(),$_POST['lesTypes'],$_POST['leBudget'],$_POST['laSurface'],$_POST['leNbPiece'],$_POST['Jardin'],$_POST['laVille']);
                    foreach ($affichages as $affichage){ ?>
                    <div class ="container-fluid">
                        <?php
                            echo 'Le bien de référence '. $affichage['ref'].' situé à ' . $affichage['ville'] . ' est au prix de ' . $affichage['prix'] . ' € <br/> <br/>';
                        ?>
                    </div>
                   <?php }}
                    else{
                        $affichages= rechercheBien(connexionBDD(),"-","-","-","-","-","-");
                        foreach ($affichages as $affichage){ ?>
                        <div class ="container-fluid">
                        <?php
                            echo 'Le bien de référence '. $affichage['ref'].' situé à ' . $affichage['ville'] . ' est au prix de ' . $affichage['prix'] . ' € <br/> <br/>';
                        ?>
                        </div>
                   <?php }} ?>
                </form> 
            </div>
        </section>
        <?php include ('../inc/piedpage.inc'); ?> 
        </body>
    </html>
    