/*
Huallpa wilson
Aplicación Nº 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.
*/

<h1>Ejercicio 10</h1>

<?php

$vector = array(
    array('color' => 'verder', 'marca' => 'marca1', 'trazo' => 'fino' , 'precio' => 50.00),
    array('color' => 'verder', 'marca' => 'marca2', 'trazo' => 'grueso' , 'precio' => 60.32),
    array('color' => 'verder', 'marca' => 'marca3', 'trazo' => 'fino' , 'precio' => 90.72)
);
foreach ($vector as $key => $value) {
    echo ('<br> Lapicera ' . $key + 1);
    foreach ($value as $k => $v) {
        echo ('<br>' . $k . ' = ' . $v);    
    }
}
?>