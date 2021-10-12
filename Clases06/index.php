<?php





$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    case 'GET':

        require_once "funciones/listado.php";
        require_once "funciones/archivo.php";
        break;

    case 'POST':
        
        // IF EN BACE SERVER
        require_once "funciones/registro.php";
        require_once "funciones/login.php";
        require_once "funciones/altaProducto.php";
        require_once "funciones/realizarVenta.php";
        require_once "funciones/ModificacionUsuario.php";
        require_once "funciones/modificacionproducto.php";

        break;

    case 'DELETE':

        echo 'entro por el metodo delete';
        break;
    case 'PUT':

        echo 'entro por el metodo put';
        break;
}

?>