<?php
require_once ("Szamla.php");

$peter = new Szamla(1, "Péter");
$peter->egyenleg = 2500;
echo  $peter."<br>";

$szamlak = [
    new Szamla(1, "Számla 1"),
    new Szamla(2, "Számla 2"),
    new Szamla(3, "Számla 3"),
    new Szamla(4, "Számla 4")
];

$listaz = function($szamlak) {
    $i = 1;
    foreach ($szamlak as $szamla){
        echo" $i. számla:";
        echo $szamla ;
        $i++;
    }
};

$listaz($szamlak);
foreach ($szamlak as $szamla){
    if(rand(0, 1))
        $szamla->betesz(rand(0, 500));
    else
        $szamla->kivesz(rand(100, 2000));
}

$osszeg = 0;
foreach ($szamlak as $szamla){
    $osszeg += $szamla->getEgyenleg();
}

echo "Összesen: $osszeg <br>";

array_walk($szamlak, function (Szamla $szamla){echo "Kedves ". $szamla->getNev().", egyenlege: ".$szamla->getEgyenleg() ."<br>";});