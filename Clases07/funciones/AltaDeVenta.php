<?php
 
 /*4- (2 pts.) AltaVenta.php, ...( continuación)Todo lo anterior más...
 a-Debe recibir un cupón de descuento, se verifica que exista y que no esté usado, (si existe) y guardar el importe
 final y el descuento aplicado en la venta.
 b-Debe marcarse el cupón como ya usado.*/

    require_once 'bd.php';
    require_once 'clases/Pizza.php';
    require_once 'clases/Venta.php';

    function AltaDeVenta($mail,$sabor,$tipo,$cantidad,$file, $cupon_id){

        $nuevaVenta = new venta();
        $nuevaVenta->mail=$mail;
        $nuevaVenta->sabor=$sabor;
        $nuevaVenta->tipo=$tipo;
        $nuevaVenta->cantidad=$cantidad;
        $nuevaVenta->numeroPedido= rand(100,500);
        $nuevaVenta->fecha = date("Y/m/d");
        $nuevaVenta->descuento = $cupon_id;
        $dir_subida = 'ImagenesDeLaVenta/fotos/';
        $arrayPizza = array();

            if(pizza::LeerJson("Archivos/Pizza.json",$arrayPizza)){

            $retorno=$nuevaVenta->VerificarSiExiteYDescontarStock($arrayPizza);

            if($retorno == 1){

                $aux = json_encode($arrayPizza,true);
                pizza::GuardarJSON("Archivos/Pizza.json",$aux);

                $UltimoId=$nuevaVenta->InsertarElVentaParametros();
                
                $nuevaVenta->SubirAchivo($dir_subida,$file);
                echo "Ingresado un producto nuevo numero: ", $UltimoId ,"\n";
                
            }else if($retorno == 0){
                echo "no tiene estock el producto";
            } else {
                echo "no exite el producto";
            }
            
        }

    }


    
 
 ?>