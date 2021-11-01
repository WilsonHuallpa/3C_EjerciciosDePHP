
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