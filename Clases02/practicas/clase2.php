<?php
// funciona igual lo que cambia es el comportamiento.
require "funciones.php";
require "usuario.php";
require "inicio.php";
//require trae todos lo de la clases.
//include "funcione.php";
// el include va traer cosas que no son totalmente requerida.
// segun la funcionalidad que tiene mi archivo vamos a usar el require o include.
saludar();

$unUsario = new Usuario();
$unUsario->nombre = "wilson";
echo( "<br>" . $unUsario->nombre);
$unUsario->apellido = "huallpa";

echo("<br>");
var_dump($unUsario);
echo("<br>");
MostrarUsuario($unUsario);

?>
<!-- Fatal error: Cannot declare class usuario, because the name is already in use in C:\xampp\htdocs\programacion_3\Clases02\usuario.php on line 2
incluimos dos veces el archivo el usuario.
-->