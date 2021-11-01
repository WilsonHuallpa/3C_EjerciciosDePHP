<?php


require_once "clases/Pizza.php";


function ConsultarPizza($sabor, $tipo){
    
   $arrayPizza = array();
   $retorno = "Error.. al leer archivo";
   if(pizza::LeerJson("Archivos/Pizza.json",$arrayPizza)){

        $retorno = "no exite el producto";
        foreach($arrayPizza as $prod){

            if($prod["sabor"] == $sabor && $prod["tipo"] == $tipo){
                
                $retorno = "exite el producto";
                break;
            } else {
                $retorno ="No exite, el tipo o el sabor.";
            }
        }

   }
   return $retorno;

}

?>