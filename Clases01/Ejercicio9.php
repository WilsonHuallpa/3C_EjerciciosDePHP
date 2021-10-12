/*
Huallpa wilson
Aplicación Nº 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.
*/

<h1>Ejercicio 9</h1>

<?php

$lapicera1 =  array('color' => 'verder', 'marca' => 'marca1', 'trazo' => 'fino' , 'precio' => 50.00);
$lapicera2 =  array('color' => 'verder', 'marca' => 'marca2', 'trazo' => 'grueso' , 'precio' => 60.32);
$lapicera3=  array('color' => 'verder', 'marca' => 'marca3', 'trazo' => 'fino' , 'precio' => 90.72);
echo ('<br><br> Lapicera 1');
foreach ($lapicera1 as $key => $value){
    echo ('<br>' . $key . ' = ' . $value);
}
echo ('<br><br> Lapicera 2');
foreach ($lapicera2 as $key => $value){

    echo ('<br>' . $key . ' = ' . $value);
}
echo ('<br><br> Lapicera 3');
foreach ($lapicera3 as $key => $value){
    echo ('<br>' . $key . ' = ' . $value);
}

?>
