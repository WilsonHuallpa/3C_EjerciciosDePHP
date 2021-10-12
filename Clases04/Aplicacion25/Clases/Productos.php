<?php

class producto {

    public $codigo;
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;
    public $id;

    public function __construct ($_id, $_nombre, $_tipo, $_stock, $_precio, $_codigo){
        $this->id = $_id;
        $this->nombre = $_nombre;
        $this->tipo = $_tipo;
        $this->stock = $_stock;
        $this->precio = $_precio;
        $this->codigo = $_codigo;
    }

    public static function AltaProducto($ruta, $objeto){
        $retorno;
        $array = array();
        if(producto::LeerJson($ruta,$array)){
            if($objeto->VerificarProducto($array)){
                $aux = json_encode($array,true);
                $retorno = "se modifico";
            }else{
                array_push($array,$objeto);
                $aux = json_encode($array,true);
                $retorno = "se agrego";
            }
        }
        else{
            array_push($array,$objeto);
            $aux = json_encode($array,true);
        }
        producto::GuardarJSON($ruta,$aux);

        return $retorno;
    }

    public static function GuardarJSON($ruta,$aux){
        $archivo = fopen($ruta,'w');
        if(fwrite($archivo,$aux ."\n") > 0){
            return true;
        }
        fclose($archivo);
    }
    
    public static function LeerJson($ruta, &$array){

        if(file_exists($ruta)){
            $data = file_get_contents($ruta);
            if($array = json_decode($data,true)){
                return true;
            }else{
                echo "Error..  no se puede decodificar";
            }
        }
        return false;
    }

    public function VerificarProducto(&$arrayProducto){
    
        foreach($arrayProducto as &$prod){
            if($prod["codigo"] == $this->codigo){
                $prod["stock"]=(string)($prod["stock"]+$this->stock);
                return true;
            }
        }
     
        return false;
    }

    public function Equals($miArray){

        foreach ($miArray as $value) {
            if($value['codigo'] == $this->codigo){
                return true;
            }
        }
        return false;
    }

}


?>