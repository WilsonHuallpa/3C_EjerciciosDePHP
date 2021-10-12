<?php
require_once "Auto.php";


class Garage{

    private $_razonSocial;
    private $_precioPorHora;
    private $_autos = [];

    public function __construct($razonSocial, $precioHora ){

        $this->_razonSocial = $razonSocial;
        $this->_precioPorHora = $precioHora;

    }

    public function MostrarGarage(){
        
        echo "<br> Razon Social: " . $this->_razonSocial;
        echo "<br> Precio por Hora: " . $this->_precioPorHora;
        echo "<br> Todos los auto: <br>";
        foreach ($this->_autos as $value) {
            echo Auto::MostrarAuto($value) . "<br>";
        }
    }

    public function Equals($a){

        foreach ($this->_autos as $value) {
            if($value == $a) { 
                return true;
            }
        }
        return false;
    }

    public function Add($a){

        if(count($this->_autos) == 0 || !($this->Equals($a))){
            array_push($this->_autos, $a);
        }else{
            echo "El auto se encuentra en el garage";
        }
    }

    public function Remove($a){
        if(count($this->_autos) != 0 && ($this->Equals($a))){
            foreach ($this->_autos as $key => $value) {
                if($value == $a){
                    unset($this->_autos[$key]);
                    echo "se elimino con exito";
                }
            }           
        }else echo "El auto no se encuentra en el garage";
    }
    public static function AltaDeGarage($g){
        
        $fp = fopen('archivos/garrage.csv', 'a');

        if(!$fp){
            var_dump(error_get_last());
        }else{
      
            $Array = (array)$g;
            // guardar los autos reglon por reglon.
            // guardar en garage con lo id de los datos y relacionarlo con los datos del auto csv.
            fputcsv($fp, $Array);
            
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

/*Crear un método de clase para poder hacer el alta de un Garage y, guardando los datos en un
archivo garages.csv.
Hacer los métodos necesarios en la clase Garage para poder leer el listado desde el archivo
garage.csv
Se deben cargar los datos en un array de garage. */
    
/*
continuar por aca...
public function GuardarUsuarioCSV(){

    $fp = fopen('archivos/usuario.csv', 'a');

    if(!$fp){
        var_dump(error_get_last());
    }else{
        $userArray =(array)$this;
        fputcsv($fp, $userArray);
        echo 'el archivo se guardo ok';
        fclose($fp);
    }
}

public static function MostrarTodos(){

    $file = 1;
    if(($ar = fopen('archivos/usuario.csv', 'r')) !== false){
        $data = array();
        while(($data =  fgetcsv($ar,1000, ',')) !== false){
            $numero =  count($data);
            echo "<p> <strong> $numero campo en la linea $file: </strong></p>\n";
            $file++;
            for ($c=0; $c < $numero ; $c++) { 
                echo $data[$c] ."<br/> \n";
            }
        }
        fclose($ar);
    }
}
*/
}
?>