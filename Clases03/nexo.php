<?php
require "usuario.php";

$opcion='';
$usuario = '';

if($_SERVER['REQUEST_METHOD'] === "GET"){
    var_dump($_GET);
    
} else if($_SERVER['REQUEST_METHOD'] === "POST"){

    if(isset($_POST['nombre']) && isset($_GET['opcion'])){
        $usuario = $_POST['nombre'];
        $opcion = $_GET['opcion'];


    }else{

        echo 'falta parametros y valores en el request';
    }

}

switch($opcion){
    case 'mostrar':
        Usuario::MostrarUsuario($usuario);
        break;
    case 'crear':
        Usuario::CrearUsuario($usuario);
        break;
    case 'MostrarTodo':
        Usuario::MostrarTodos();
        break;
}


?>
