<?php

require_once "Clases/Archivos.php";

class venta{

    public function __construct ($_id, $_codigo, $_idUsuario, $_cantidad){
        $this->id = $_id;
        $this->codigo = $_codigo;
        $this->IdUsuario = $_idUsuario;
        $this->cantidad = $_cantidad; 
    }


    public function verificarCodigoProducto($arrayProd){
        
        foreach ($arrayProd as $key => $prod) {
            if($prod["codigo"] == $this->codigo){
                return $key;
            }
        }
        return -1;
    }

    public function verificarIDUsser($arrayUsser){
        
        foreach ($arrayUsser as $key => $usser) {
            if($usser["id"] == $this->IdUsuario){
                return true;
            }
        }
        return false;
    }
    public static function AltaDeVentas($ruta, $objeto){
        $array = array();
        if(Archivo::LeerJson($ruta,$array)){
            array_push($array,$objeto);
            $aux = json_encode($array,true);
        }
        else{
            array_push($array,$objeto);
            $aux = json_encode($array,true);
        }
       return Archivo::GuardarJSON($ruta,$aux);
    }
    
    public function VerificarStockIdUsuario(){
        
    }
    public function ReducirStockDeProducto($array, $index , $item){
        
    }

}






?>