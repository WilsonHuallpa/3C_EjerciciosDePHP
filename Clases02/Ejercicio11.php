/*
Huallpa wilson
Aplicación Nº 11 (Potencias de números)
Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 (hacer una función
que las calcule invocando la función pow).

*/
<h1>Ejercicio 11 </h1>

<?php

CalcularPotencia();

function CalcularPotencia(){
    
    for ($j=1; $j <= 4 ; $j++) { 
        echo ("<br> potencio". $j ."<br>");
        for ($i=1; $i<=4 ; $i++) {
            echo ('<br>');
            echo( pow($j, $i));
        }
    }
}
?>