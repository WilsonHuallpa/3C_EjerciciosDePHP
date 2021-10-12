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
        /*
        Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
        que mostrará todos los atributos del objeto. */
    }

    public function Equals($a){

        foreach ($this->_autos as $value) {
            if($value == $a) { 
                return true;
            }
        }
        return false;
/*
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
 */
    }

    public function Add($a){

        if(count($this->_autos) == 0 || !($this->Equals($a))){
            array_push($this->_autos, $a);
        }else{
            echo "El auto se encuentra en el garage";
        }
/*
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
(sólo si el auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
 */
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
        /*
        Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
        “Garage” (sólo si el auto está en el garaje, de lo contrario informarlo).
         */
    }
    /* Ejemplo: $miGarage->Remove($autoUno);
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
métodos.*/


}
?>