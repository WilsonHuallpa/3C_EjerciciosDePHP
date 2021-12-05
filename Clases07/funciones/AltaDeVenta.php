<?php
    require_once 'clases/Venta.php';

    function AltaDeVenta($usuario, $mail,$sabor,$tipo,$cantidad,$file){

        try{
            $nuevaVenta = new venta();
            $nuevaVenta->usuario=$usuario;
            $nuevaVenta->mail=$mail;
            $nuevaVenta->sabor=$sabor;
            $nuevaVenta->tipo=$tipo;
            $nuevaVenta->cantidad=$cantidad;
            $nuevaVenta->numeroPedido= rand(100,500);
            $nuevaVenta->fecha = date("Y/m/d");

            $dir_subida = 'ImagenesDeLaVenta/';
            $arrayCupon = array();
            $arrayPizza = array();
    
            Archivo::LeerJson("Archivos/Pizza.json",$arrayPizza);
            Archivo::LeerJson("Archivos/cupones.json",$arrayCupon);

    
            $index=Venta::VerificarSiExiteProducto($arrayPizza ,$nuevaVenta);

            $precioProcto=$nuevaVenta->DescontarStock($arrayPizza, $index);


            $retorno = $nuevaVenta->AplicarDescuento($precioProcto, $arrayCupon);

            $aux = json_encode($arrayPizza,true);
            Archivo::GuardarJSON("Archivos/Pizza.json",$aux);
            $nuevaVenta->SubirAchivo($dir_subida,$file);

            $UltimoId=$nuevaVenta->InsertarElVentaParametros();

            if($retorno == 1){  
                $auxcupon = json_encode($arrayCupon,true);
                Archivo::GuardarJSON("Archivos/cupones.json",$auxcupon);
                echo " Ingresado un producto Con descuento nuevo numero: ", $UltimoId ,"\n";
            }else if($retorno == 0){
                echo "Cupo ya usado. Ingreso un producto nuevo numero: ", $UltimoId ,"\n";
            } 
                
        }catch(Exception $e) {
            $payload = json_encode(array('error' => $e->getMessage()));
            echo $payload;
        }

    }


    
 
 ?>