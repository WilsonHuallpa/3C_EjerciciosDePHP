/*
Huallpa Wilson

Ejercicio 2

Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.
*/
<h1>Ejercicio 2</h1>

<?php

   $fecha = date("Y / m / d");
   $mes = date("m");
   $dia = date("d");

   echo " Fecha : ", $fecha;

   switch($mes){

    case 1:
    case 2:
        printf("</br>VERANO");
        break;
    case 3:
        if($dia <= 20){
            printf("</br>VERANO");
        }else{
            printf("</br> OTOÑO");
        }
        break;
    case 4:
    case 5:
        printf("</br>OTOÑO");
    case 6:
        if($dia <= 20){
            printf("</br>OTOÑO");
        }else{
            printf("</br>INVIERNO");
        }
        break;
    case 7:
    case 8:
        printf("</br>INVIERNO");
        break;
    case 9:
        if($dia <= 20){
            printf("</br>INVIERNO");
        }else{
            printf("</br>PRIMAVERA");
        }
        break;
    case 10:
    case 11:
        printf("</br>PRIMAVERA");
    case 12:
        if($dia <= 20){
            printf("</br>PRIMAVERA");
        }else{
            printf("</br>VERANO");
        }
        break;
   }
?>