/*
wilson huallpa

Aplicación No 33 ( ModificacionProducto BD)
Archivo: modificacionproducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
,
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto el stock se sobrescribe y se cambian todos los datos excepto:
el código de barras .
Retorna un :
“Actualizado” si ya existía y se actualiza
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase


 */
 <h1>Aplicacion 33 </h1>

 <?php


require_once 'bd.php';
require_once 'clases/productos.php';

if(isset($_POST['CodigoDeBarra']) && isset($_POST['nombre']) && isset($_POST['tipo']) && isset($_POST['stock']) && isset($_POST['precio'])){

    $codigoProduc = $_POST['CodigoDeBarra'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];

    $unproducto = new producto();

    $unproducto->codigo = $codigoProduc;
    $unproducto->nombre = $nombre;
    $unproducto->tipo = $tipo;
    $unproducto->stock = $stock;
    $unproducto->precio = $precio;
    $unproducto->fechaCreacion = date("Y/m/d");
    $unproducto->fechaModificacion = "0000-00-00";
 
    if($unproducto->verificarCodigoBD()){
        $modificado = $unproducto->ModificarProductoParametros();
        print "Actualizado producto: $codigoProduc, se modifico:  $modificado";
    }else{
        echo "Error... No exite el producto " , $codigoProduc;
    }

}
 ?>