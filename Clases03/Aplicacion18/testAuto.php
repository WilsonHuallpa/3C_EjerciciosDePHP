<?php
require "Auto.php";

$a1 = new Auto("marca1","rojo");
$a2 = new Auto("marca1","verde");

$a3 = new Auto("marca2","verde", 200.50);
$a4 = new Auto("marca2","verde", 250);
$a5 = new Auto("marca4","azul", 300, date("Y / m / d"));

$a3->AgregarImpuestos(1500);
$a4->AgregarImpuestos(1500);
$a5->AgregarImpuestos(1500);


$importe = Auto::add($a3, $a4);

if($a1->Equals($a2)){
    echo "son iguales";
}else echo "<br> no son iguales";

if($a1->Equals($a5)){
    echo "son iguales";
}else echo "<br> no son iguales";

echo "<br>". $importe . "<br>";
Auto::MostrarAuto($a3);

Auto::AltaDeAuto($a1);
Auto::AltaDeAuto($a2);
Auto::AltaDeAuto($a3);

Auto::LeerListado();

?>