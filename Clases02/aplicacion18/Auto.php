<?php
class Auto{

    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($marca,$color,$precio = 0,$fecha = " "){

        $this->_marca = $marca;
        $this->_color = $color;
        $this->_precio = $precio;
        $this->_fecha = $fecha;

    }
    public function AgregarImpuestos($impuesto){

        $this->_precio += $impuesto;

    }
    public static function MostrarAuto($a){
        
        if(is_a($a,'Auto')){
            foreach ($a as $key => $value) {
                echo (" " . $value);
            }
        }
    }
    public function Equals($a1){

        if(is_a($a1,'Auto')){
            if($a1 == $this){
                return true;
            }else {
               return false;
            }
        }
    }

    public static function Add($a1, $a2){

        $retorno = 0;
        if($a1->Equals($a2)){
            $retorno = $a1->_precio + $a2->_precio;
        }else{
            echo "Error... lo autos no son del mismo tipo";
        }
        return $retorno;
    }

}

?>