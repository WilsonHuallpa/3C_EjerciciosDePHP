/*
Huallpa wilson
Aplicación Nº 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado. */
<h1> ejercicio 6 </h1>
<?php

$vec =  array(rand(1,9), rand(1,9), rand(1,9), rand(1,9), rand(1,9));
$acumulador=array_sum($vec);
$promedio = (int)($acumulador /5);
if($promedio > 6){
    echo ('<br>' . $promedio . ' es mayor a 6');
}else if($promedio < 6){
    echo ('<br>' . $promedio . ' es menor a 6');
}else{
    echo ('<br>' . $promedio . ' es igual a 6');
}
?>
