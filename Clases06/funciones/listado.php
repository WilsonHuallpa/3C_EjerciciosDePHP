
<?php

require_once "bd.php";
require_once 'clases/usuario.php';
require_once 'clases/ventas.php';
require_once 'clases/productos.php';


if(isset($_GET['listados'])){

    
    $correcto = "";
    $listado = $_GET['listados'];

    switch($listado){
        case "usuarios":

            $arrayuser = usuario::TraerTodoLosUsuario();
            echo usuario::DibujarListado($arrayuser);
            break;
        case "productos":
            $arrayProc = producto::TraerTodoLosProducto();
            echo producto::DibujarListado($arrayProc);
            break;

        case "ventas":
            $arrayVentas = venta::TraerTodoLasVentas();
            echo venta::DibujarListado($arrayVentas);
            break;
        default:
            $correcto="no";
            break;
    }

    if($correcto == "no"){
        echo "no hay listado";
    }
}


?>