/*
wilson huallpa
Aplicación No 31 (RealizarVenta BD )
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
Verificar que el usuario y el producto exista y tenga stock.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases

 */

 <h1>Aplicacion 31</h1>

 <?php

require_once 'bd.php';
require_once 'clases/productos.php';
require_once 'clases/usuario.php';
require_once 'clases/ventas.php';

if(isset($_POST['CodigoDeBarra']) && isset($_POST['IdUsuario']) && isset($_POST['Item'])){

    $codigoProduco = $_POST['CodigoDeBarra'];
    $idUsuario = $_POST['IdUsuario'];
    $cantidadItem = $_POST['Item'];

    $usuario = usuario::TraerUnUsuario($idUsuario);
    $producto = producto::TraerUnProducto($codigoProduco);

    if($usuario != false && $producto != false){

        if($producto->stock > $cantidadItem){

            $unaVenta = new venta();
            $unaVenta->_idProducto = $producto->id;
            $unaVenta->_idUsuario = $idUsuario;
            $unaVenta->_cantidad = $cantidadItem;
            $unaVenta->_fecha = date("Y/m/d");
            $ultimaItem = $unaVenta->InsertarElVentaParametros();
            $producto->stock -= $cantidadItem;
            $modifaciones = $producto->ModificarProductoParametros();

            echo "Venta realizada";
        }else{
            echo "No se puede hacer.. hay stock \n";
        }

    }else{
        echo "No se puede hacer... no existe el producto o usuario";

    }

}


 ?>