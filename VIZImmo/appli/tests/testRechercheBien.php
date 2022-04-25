<?php

include_once '../modeles/mesFonctionsAccesAuxDonnees.php';


echo "Test 0 critères";

var_dump(rechercheBien(connexionBDD(),"-","-","-","-","-","-"));
echo "Test 1 critères";
var_dump(rechercheBien(connexionBDD(), 1,"-","-","-","-","-"));
echo "Test plusieurs critères";
var_dump(rechercheBien(connexionBDD(), 4,"-",3,"-",1,'Croix'));