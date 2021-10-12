<?php
// require "usuario.php";
require_once "usuario.php"; 
// lo requiere solo una sola ves.
function MostrarUsuario($usuario){
    echo "bienvenido ". $usuario->nombre ;
}

// $usuario =  new usuario();
// $usuario->nombre = "ariel";

// MostrarUsuario($usuario);


?>