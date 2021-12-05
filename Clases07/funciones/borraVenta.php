<?php

require_once "bd.php";
require_once "clases/Venta.php";


function BorrarVenta($numeroPedido){

    $retorno = "No se encuentra el elemento";
    $venta =  venta::TraerVenta($numeroPedido);

    var_dump($venta);
    if($venta != false){

        if(is_file($venta->imagen)){

            if(Archivo::MoverArchivoImagen("BACKUPVENTAS/" , $venta->imagen)){

                venta::BorrarVenta($venta);
            
                $retorno = "Se borro corectamente.";
            }else{
                $retorno = "Error.. al mover el archivo..";
            }
        }else{
            $retorno= "no exite el archivo.";
        }
    }
    return $retorno;
}

?>
