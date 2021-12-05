<?php
require_once 'clases/Devolucion.php';


function ListarDevolucionesCupones(){

    $ruta = "archivos/devoluciones.json";
   
   $arrayDevoluciones = array();

   if(Archivo::LeerJson($ruta,$arrayDevoluciones)){

      foreach ($arrayDevoluciones as $key => $value) {
        
         echo "numero pedido: " . $value["numeroPedido"] . "\n";
         echo "causa: " .$value["causa"] . "\n";
         echo "causa: " .$value["fecha"] . "\n";
         echo "usuario: " . $value["usuario"] . "\n" ;
         echo "idCupon: " . $value["idCupon"] . "\n \n" ;
      }
   }
   else{
       echo "no exite registro de cupones.";
   }
}

function ListarDevolucionesPorUsurio(){
    $ruta = "archivos/devoluciones.json";
   
    $arrayDevoluciones = array();
 
    if(Archivo::LeerJson($ruta,$arrayDevoluciones)){
 
     array_sort_by($arrayDevoluciones, 'usuario', $order = SORT_ASC);
 
       foreach ($arrayDevoluciones as $key => $value) {
         
          echo "numero pedido: " . $value["numeroPedido"] . "\n";
          echo "causa: " .$value["causa"] . "\n";
          echo "causa: " .$value["fecha"] . "\n";
          echo "usuario: " . $value["usuario"] . "\n" ;
          echo "idCupon: " . $value["idCupon"] . "\n \n" ;
       }
    }
    else{
        echo "no exite registro de cupones.";
    }
  
}

function ListarDevolucionesFecha($fecha){
    $ruta = "archivos/devoluciones.json";
   
    $arrayDevoluciones = array();
 
    if(Archivo::LeerJson($ruta,$arrayDevoluciones)){
 
       foreach ($arrayDevoluciones as $key => $value) {
        if(FiltarFecha($value["fecha"], $fecha)){

            echo "numero pedido: " . $value["numeroPedido"] . "\n";
            echo "causa: " .$value["causa"] . "\n";
            echo "causa: " .$value["fecha"] . "\n";
            echo "usuario: " . $value["usuario"] . "\n" ;
            echo "idCupon: " . $value["idCupon"] . "\n \n" ;
        }
       }
    }
    else{
        echo "no exite registro de cupones.";
    }
}




?>