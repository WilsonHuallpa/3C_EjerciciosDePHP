<?php

require_once "Auto.php";
require_once "Garage.php";

$auto1 = new auto("marca1","azul",250,date("Y / m / d"));
$auto2 = new auto("marca1","negro",300,date("Y / m / d"));
$auto3 = new auto("marca2","verde",350,date("Y / m / d"));
$auto4 = new auto("marca2","rojo",300,date("Y / m / d"));
$auto5 = new auto("marca3","verde",400,date("Y / m / d"));

$garage =  new Garage("monotributo",40);


$garage->Add($auto1);
$garage->Add($auto2);
$garage->Add($auto3);

$garage->MostrarGarage();

Garage::AltaDeGarage($garage);
?>

/* Ejemplo: $miGarage->Remove($autoUno);
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
métodos.*/