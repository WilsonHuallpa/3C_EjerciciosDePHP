/*
wilson huallpa
Aplicación No 26 (RealizarVenta)
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .

Verificar que el usuario y el producto exista y tenga stock.

crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).

carga los datos necesarios para guardar la venta en un nuevo renglón.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases

 */

 <h1>Aplicacion 26</h1>

 <?php


require_once 'Clases/Archivos.php';
require_once 'Clases/Productos.php';
require_once 'Clases/Usuario.php';
require_once 'Clases/Ventas.php';




if(isset($_POST['CodigoDeBarra']) && isset($_POST['IdUsuario']) && isset($_POST['Item'])){


    $codigo = $_POST['CodigoDeBarra'];
    $idUsser = $_POST['IdUsuario'];
    $item = $_POST['Item'];
    $id =  rand(1,10000);

    $unaVenta = new venta($id, $codigo, $idUsser, $item);

    if(Archivo::LeerJson("Archivos/productos.json",$arrayProduc)){
        
        $index = $unaVenta->verificarCodigoProducto($arrayProduc);
        
        if($index != -1 && ($item <= $arrayProduc[$index]["stock"])){

            if(Archivo::LeerJson("Archivos/usuarios.json",$arrayUsser)){

                 if($unaVenta->verificarIDUsser($arrayUsser)){

                    if(venta::AltaDeVentas("Archivos/ventas.json",$unaVenta)){

                        $arrayProduc[$index]["stock"] = ($arrayProduc[$index]["stock"] - $item);
                        $aux = json_encode($arrayProduc,true);
                        Archivo::GuardarJSON("Archivos/productos.json",$aux);

                        echo "venta realizada";
                    }else{
                        echo "no se pudo realizar venta";
                    }

                 }else{
                     echo "no exite el usuario";
                 }
            }
        }
        else{
            echo "Error.. no existe el producto o no cuenta con stock suficiente";
        }
    }else{
        echo "no exite el listado";
    }


}


 ?>