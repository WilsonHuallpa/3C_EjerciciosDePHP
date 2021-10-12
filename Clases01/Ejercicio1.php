/*
Huallpa wilson
Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.
*/

<h1>Ejercicio 1</h1>

<?php

$num = 0;
$acumulador = 0;

do{
    $acumulador++;
    $num = $num + $acumulador;

}while(($num + $acumulador) < 1000);

echo "</br> total del numero sumados: ", $num;
echo "</br> cantidad de numero: ",$acumulador;

?>