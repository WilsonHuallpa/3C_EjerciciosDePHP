<?php


require_once "bd.php";
require_once "clases/usuario.php";


if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['clave']) && isset($_POST['mail']) && isset($_POST['localidad'])){

    $nombre= $_POST['nombre'];
    $apellido= $_POST['apellido'];
    $clave= $_POST['clave'];
    $mail= $_POST['mail'];
    $localidad = $_POST['localidad'];
    $fecha = date("Y / m / d");

    $user =  new usuario();

    $user->nombre = $nombre;
    $user->apellido = $apellido;
    $user->clave = $clave;
    $user->mail = $mail;
    $user->localidad = $localidad;
    $user->fecha = $fecha;

    $index =  $user->InsertarElUsuarioParametros();

    if($index > 0 ){
        echo "se puedo agregar correctamente";
    }
   
}


?>