<?php

/*
10- (3 pts.)ConsultasEspeciales.php:-
a-Listar las ventas borradas.
b-Listar Las imágenes dependiendo del parámetro que reciba , puedo mostrar las actuales o las del BackUp.
c-Listar devoluciones y sus cupones y si fueron usados o no.
Código obsoleto, copiado y pegado que no tenga utilidad (-1 punto).*/


function ListarLasVentasBorradas(){

    $listaVentas = Venta::ListarVentasBorradas();

    foreach ($listaVentas as $key => $venta) {

        echo "numero Pedido: " . $venta->numeroPedido ."\n";
        echo "Usuario: " . $venta->usuario ."\n";
        echo "sabor: " . $venta->sabor ."\n";
        echo "tipo: " . $venta->tipo ."\n";
        echo "cantidad: " . $venta->cantidad ."\n";
        echo "total: " . $venta->total."\n";
        echo "fechabaja: ". $venta->fechaBaja."\n \n";
        
    }
}
function MostrarImagenes($param){

    $listaVentas = venta::ListarVentas();
    switch($param){
        case "actuales":
            echo "imagenes actuales \n";
            foreach ($listaVentas as $value) {
                
                if($value->fechaBaja === NULL){
                    echo "imagenes: " . $value->imagen . "\n";
                }
            }
            break;
        case "backUp":
            echo "imagenes borradas \n";
            foreach ($listaVentas as $value) {
               
                if($value->fechaBaja != NULL){
                    echo "imagenes: " . $value->imagen . "\n";
                }
            }
             break;
    }
   
}
function ListarDevolucionyCupones(){


    $ruta = "archivos/devoluciones.json";
   
    $arrayDevoluciones = array();
 
    if(Archivo::LeerJson($ruta,$arrayDevoluciones)){
 
       foreach ($arrayDevoluciones as $key => $value) {
         
          echo "numero pedido: " . $value["numeroPedido"] . "\n";
          echo "causa: " .$value["causa"] . "\n";
          echo "causa: " .$value["fecha"] . "\n";
          echo "usuario: " . $value["usuario"] . "\n" ;
          DevolverEstadoCupon($value["idCupon"]);
       }
    }
    else{
        echo "no exite registro de cupones.";
    }
}

 function DevolverEstadoCupon($idCupon){
  

    $ruta = "archivos/cupones.json";
   
    $arrayCupones = array();
 
    if(Archivo::LeerJson($ruta,$arrayCupones)){
 
       foreach ($arrayCupones as $key => $value) {

        if($value["id"] == $idCupon){
            $estado;
            if($value["estado"]){
               $estado = "activo";
            }else{
               $estado = "usado";
            }
            echo "estado: " . $estado . "\n \n";
            break;
        }
       }
    }
    else{
        echo "no exite registro de cupones.";
    }

}

?>