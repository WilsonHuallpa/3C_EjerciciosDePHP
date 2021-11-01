<?php
require_once "clases/Pizza.php";

function PizzaCarga($sabor, $precio, $tipo, $cantidad, $file ){

    $ruta = "archivos/Pizza.json";
    $dir_subida = 'ImagenesDePizzas/';

    $pizza = new pizza($sabor, $precio, $tipo,$cantidad);

    $array = array();

    if(pizza::LeerJson($ruta,$array)){

        $item = end($array);
        $item_id = $item['id'];

        $pizza->id = ++$item_id;
        if($pizza->VerificarYModificar($array)){
            $aux = json_encode($array,true);
            $retorno = "se modifico";
        }else{
            array_push($array,$pizza);
            $aux = json_encode($array,true);
            $pizza->SubirAchivo( $dir_subida,$file);
            $retorno = "se agrego" ;
        }
    }
    else{
        array_push($array,$pizza);
        $aux = json_encode($array,true);
        $retorno = "se agrego primer elemento" ;
        $pizza->SubirAchivo( $dir_subida,$file);
    }
    
    if(pizza::GuardarJSON($ruta,$aux)){
        echo $retorno;
    }
}

?>