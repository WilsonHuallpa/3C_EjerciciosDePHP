/*
Huallpa Wilson

Aplicación Nº 13 (Invertir palabra)
Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán:
1 si la palabra pertenece a algún elemento del listado.
0 en caso contrario.

*/
<h1>Ejercicio 13</h1>
<?php

$palabra= "Programacison";
$entero =  13;

echo (ValidarPalabraClave($palabra,$entero));

function ValidarPalabraClave($string, $max){
    $vector =  array("Recuperatorio","Parcial","Programacion");
    if(strlen($string) <= $max ){
        foreach ($vector as $value) {
            if($string == $value){
                return 1;
            }
        }
        return 0;
    }else{
        echo("cantidad supera al maximo");
    }
}




?>
