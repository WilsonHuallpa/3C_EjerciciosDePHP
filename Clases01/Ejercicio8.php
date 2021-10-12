/*
huallpa wilson

Aplicación Nº 8 (Carga aleatoria)
Imprima los valores del vector asociativo siguiente usando la estructura de control foreach:
$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';
*/
<h1> Ejercicio 8 </h1>

<?php
$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';

foreach ($v as $key => $value) {
    echo('<br>'. "clave = ". $key ." valor = " . $value);
    // se va ver como nosotros lo fuimos agrenando
}
?>