<?php

function ModificarDevolucion($numeroPedido, $usuario , $causa){

        $ruta = "Archivos/devoluciones.json";
        $dir_subida = 'devoluciones/';
        $retorno = -1;
        $arrayDevolucion = array();

        if(Archivo::LeerJson($ruta,$arrayDevolucion)){

            foreach ($arrayDevolucion as &$value) {
                if($value["numeroPedido"] == $numeroPedido && $value["usuario"] == $usuario){
                    $value["causa"]= $causa;
                    $value["fecha"]= date("Y/m/d");
                    $retorno = 1;
                    break;
                }
            }
            if($retorno){
                $aux = json_encode($arrayDevolucion,true);
                Archivo::GuardarJSON($ruta,$aux);
            }
        }

        return $retorno;
        
 }

?>