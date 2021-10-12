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
            if($a1->_marca == $this->_marca){
                return true;
            }else {
               return false;
            }
        }

    }
    public static function Add($a1, $a2){

        $retorno = 0;
        if($a1->Equals($a2) && $a1->_color == $a2->_color){
            $retorno = $a1->_precio + $a2->_precio;
        }else{
            echo "Error... lo autos no son del mismo tipo";
        }
        return $retorno;
    }

    public static function AltaDeAuto($auto){
        
        $fp = fopen('archivos/autos.csv', 'a');

        if(!$fp){
            var_dump(error_get_last());
        }else{
            
            $autoArray = (array)$auto;
            
            fputcsv($fp, $autoArray);

            echo '<br> el archivo se guardo ok';
            fclose($fp);
        }
    }
    public static function LeerListado(){
        $fila = 1;
        if(($file = fopen('archivos/autos.csv', 'r')) !== FALSE){
            while(($dato = fgetcsv($file,1000,",")) !== FALSE){
                $numero = count($dato);
                echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
                $fila++;
                for ($c=0; $c < $numero; $c++) {
                    echo $dato[$c] . "<br />\n";
                }
            }
        }
        fclose($file);
    }
    
}

?>