<?php
/*
    Huallpa Wilson
    Ejercicio 17.
*/
class auto{

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
        if(is_a($a,'auto')){
            foreach ($a as $key => $value) {
                echo (" " . $value);
            }
        }
    }
    public function Equals($a1){

        if(is_a($a1,'auto')){
            if($a1->_marca == $this->_marca){
                return true;
            }else false;
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

}

/*Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
● Crear un objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
al atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
5) */
/*
$a1 = new auto("marca1","rojo");
$a2 = new auto("marca1","verde");

$a3 = new auto("marca2","verde", 200.50);
$a4 = new auto("marca2","verde", 250);
$a5 = new auto("marca4","azul", 300, date("Y / m / d"));

$a3->AgregarImpuestos(1500);
$a4->AgregarImpuestos(1500);
$a5->AgregarImpuestos(1500);


$importe = auto::add($a3, $a4);

if($a1->Equals($a2)){
    echo "son iguales";
}else echo "<br> no son iguales";

if($a1->Equals($a5)){
    echo "son iguales";
}else echo "<br> no son iguales";

echo "<br>". $importe . "<br>";
auto::MostrarAuto($a3);*/

?>