/*
Huallpa Wilson

Ejercicio 3

Aplicación No 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido.
Ejemplo 1: $a = 6; $b = 9; $c = 8; => se muestra 8.
Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”

*/
<?php

  $a = mt_rand(1,9);
  $b = mt_rand(1,9);
  $c = mt_rand(1,9);


  echo('<br>' . ' Numeros elegido ala zar '. $a ."-" . $b . "-" . $c);
 

  if(($a < $b && $a > $c) || ($a > $b && $a < $c)){
    
    echo "</br>Numero del medio: ", $a;
  }else if(($b < $a && $b > $c) || ($b > $a && $b < $c)){

    echo "</br>Numero del medio:", $b;
  }else if($c < $a && $c > $b || $c > $a && $c < $b){
    echo "</br>Numero del medio: ", $c;
  }else{
    echo "</br>No hay valor del medio";
  }

?>