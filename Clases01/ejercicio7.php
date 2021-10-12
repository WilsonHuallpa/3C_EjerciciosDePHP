/*
huallpa wilson
Aplicación Nº 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números utilizando
las estructuras while y foreach.
*/
<h1>Ejercicio 7 </h1>
<?php

$contador = 0;
$vector = array();
while($contador < 10){

    $num =  rand(1,100);
    if($num % 2 != 0){
        array_push($vector, $num);
        $contador++;
    }
}
// count = Cuenta todos los elementos de un array o algo de un objeto
for ($i=0; $i < count($vector) ; $i++) { 
    echo ('<br>' . $vector[$i]);
}
echo ('<br> <br>');
$x = 0;
while( $x < count($vector) ){
    echo ('<br>' . $vector[$x]);
    $x++;
}
echo ('<br> <br>');
foreach ($vector as $value) {
    echo ('<br>' . $value);
}
?>