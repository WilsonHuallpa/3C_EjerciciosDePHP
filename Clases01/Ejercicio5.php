/*
Huallpa Wilson

Ejercicio 5

Aplicación No 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.

*/
<h1>Ejercicio 5 </h1>

<?php

$num = mt_rand(20,60);

echo mostrarEnpalabras($num);

function mostrarEnpalabras($num){
    
    $l = strval($num);
    //obtiene le valor de cadena de una variable. 
    $num1 = $l[0];
    $num2 = $l[1];
    $n;
    echo $l;
    switch($num1){

        case '2':
            if($num2 != 0){
                $n = mostrarEnpalabrasAl9($num2);
                return " Veinte y $n ";
            }else{
                return " Veinte";
            }
            break;
        case '3': 
            if($num2 != 0){
                $n = mostrarEnpalabrasAl9($num2);
                return " Treinta Y $n";
            }else{
                return " Treinta";
            }
            break;
        case '4':
            if($num2 != 0){
                $n = mostrarEnpalabrasAl9($num2);
                return " Cuarenta y $n";
            }else{
                return " Cuarenta";
            }
            break;
        case '5':
            if($num2 != 0){
                $n = mostrarEnpalabrasAl9($num2);
                return " Cincuenta y $n";
            }else{
                return " Cincuenta";
            }
            break;
        case '6':
            if($num2 != 0){
                $n = mostrarEnpalabrasAl9($num2);
                return " Sesenta Y $n ";
            }else{
                return " Sesenta";
            }
            break;
    }
}

function mostrarEnpalabrasAl9($num2){

    switch($num2){
        case 1:
            return "Uno";
            break;
        case 2:
            return "Dos";
            break;
        case 3:
            return "Tres";
            break;
        case 4:
            return "Cuatro";
            break;
        case 5:
            return "Cinco";
            break;
        case 6:
            return "Seis";
            break;
        case 7:
            return "Siete";
            break;
        case 8:
            return "Ocho";
            break;
        case 9:
            return "Nueve";
            break;
    }
}
?>