/*
Huallpa wilson
Aplicación Nº 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.


*/
<h1>Ejercicio 12</h1>

<?php
$vector = array('H','O','L','A');
$num=  1;
InvertirOrden($vector);
function InvertirOrden($vec){
    if(is_array($vec)){
        // krsort — Ordena un array por clave en orden inverso
        krsort($vec);
        foreach ($vec as $value){
            echo($value);
        }
    }else{
        echo ("Debe de ser de tipo array");
    }
    
}
?>