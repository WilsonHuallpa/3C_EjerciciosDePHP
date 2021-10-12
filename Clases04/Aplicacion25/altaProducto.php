
<?php
 
/*
Aplicación No 25 ( AltaProducto)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).

crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto se le suma el stock , de lo contrario se agrega al documento en un
nuevo renglón
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase */

require_once 'Clases/Productos.php';

if(isset($_POST['codigo']) && isset($_POST['nombre']) && isset($_POST['tipo']) && isset($_POST['stock']) && isset($_POST['precio'])){

    
    $id = rand(1,10000);
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];
    $codigo = $_POST['codigo'];
    // $arrayProd = array();
    $producto = new producto($id, $nombre, $tipo, $stock, $precio, $codigo);

    echo producto::AltaProducto("Archivos/productos.json", $producto);
    
    //    GuardarJSON
    /*
   $retorno = producto::GuardarJSON("Archivos/prod.json", $producto);


   if($arrayProducto != null){

       if($producto->VerificarProducto($arrayProducto)){

           var_dump($arrayProducto);
           $handler = fopen("Archivos/productos.json", "w");
           foreach($arrayProducto as $pro){

               $json_string = json_encode($pro);
               fwrite($handler,$json_string . "\n");
           }
           fclose($handler);
           echo "se modifico el stock del producto.";
   
       }else if(producto::AltaDeProducto($producto)){

           echo "Los datos se guardaron correctamente.";
           }else{
           echo "se produjo un error.";
           }
       }
   }else{

       if(producto::AltaDeProducto($producto)){

           echo "Los datos se guardaron correctamente.";
       }else{
           echo "se produjo un error.";
       }

   }*/
}
?>