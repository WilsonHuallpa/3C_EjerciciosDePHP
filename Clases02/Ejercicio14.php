/*
Huallpa wilson
Aplicación Nº 14 (Par e impar)
Crear una función llamada esPar que reciba un valor entero como parámetro y devuelva TRUE
si este número es par ó FALSE si es impar.
Reutilizando el código anterior, crear la función esImpar.

*/
<h1>Ejercicio 14</h1>

<?php

$num =  3;

if(esImpar(2)){
    echo ("es impar");
}else{
    echo("es par");
}
if(esPar(7)){
    echo ("<br>es par");
}else{
    echo("<br>es Impar");
}
function esPar($num){

    if($num % 2 == 0){
        return true;
    }else{
        return false;
    }
}
function esImpar($num1){
    $retorno =  esPar($num1);
    return !$retorno;
}
?>