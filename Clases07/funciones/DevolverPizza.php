
<?php
    require_once 'clases/Venta.php';
    require_once 'clases/Devolucion.php';
    require_once 'clases/Cupon.php';

function DevolverPizza ($usuario, $numeroPedido, $causa, $file){

    try{
        $retorno =  false;
        $unVenta = Venta::TraerVenta($numeroPedido);

        if($unVenta != false){
            
            $devolucion =  new Devolucion();
            $devolucion->id = 1;
            $devolucion->numeroPedido = $numeroPedido;
            $devolucion->causa = $causa;
            $devolucion->usuario = $usuario;
            $devolucion->fecha = date("Y/m/d");;
            $devolucion->idCupon = 1;

            $ruta = "Archivos/devoluciones.json";
            $dir_subida = 'devoluciones/';

            $array = array();

            if(Archivo::LeerJson($ruta,$array)){

                $item = end($array);
                $item_id = $item['id'];
                $devolucion->id = ++$item_id;
                $devolucion->SubirAchivo( $dir_subida,$file);
                array_push($array,$devolucion);
                $aux = json_encode($array,true);
                $retorno = true ;
            }else{
                $devolucion->SubirAchivo( $dir_subida,$file);
                $devolucion->cargarUnoBD();
                array_push($array,$devolucion);
                $aux = json_encode($array,true);
                $retorno = true;
            }
            
            Archivo::GuardarJSON($ruta,$aux);
        }
        if($retorno){
            $cupon = new Cupon();
            $cupon->id = 1;
            $cupon->estado = true;
            $cupon->fecha = date("Y/m/d");
            $cupon->monto = 10;
            $cupon->usuario = $usuario;
            $ruta = "Archivos/cupones.json";
            $array = array();
            
            if(Archivo::LeerJson($ruta,$array)){

                $item = end($array);
                $item_id = $item['id'];
                $cupon->id = ++$item_id;
                array_push($array,$cupon);
                $aux = json_encode($array,true);
                $retorno = true ;
            }else{
                array_push($array,$cupon);
                $aux = json_encode($array,true);
                $retorno = true;
            }
            Archivo::GuardarJSON($ruta,$aux);
        
        }

    }catch(Exception $e) {
        $payload = json_encode(array('error' => $e->getMessage()));
        echo $payload;
    }
   
    
}




?>
