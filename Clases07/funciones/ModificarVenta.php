<?php

require_once "bd.php";
require_once "clases/Venta.php";

parse_str(file_get_contents('php://input'), $_PUT);


function ModificarVenta($numeroPedido, $mail, $sabor, $tipo, $cantidad ){

    $retorno;
    
    $venta = new venta();
    $venta->numeroPedido = $numeroPedido;
    $venta->mail =  $mail;
    $venta->sabor = $sabor;
    $venta->tipo = $tipo;
    $venta->cantidad =$cantidad;

    $unaVenta = venta::TraerVenta($numeroPedido);

    if($unaVenta != false){
        
        $venta->ModificarVentaParametros();

        $retorno =  " se modifico";
    }else{
        $retorno =  "no exite el elemento";
    }

    return $retorno;
 }

?>