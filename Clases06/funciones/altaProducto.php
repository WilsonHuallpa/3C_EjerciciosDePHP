
 <?php
 
    require_once 'bd.php';
    require_once 'clases/productos.php';

 
 if(isset($_POST['codigo']) && isset($_POST['nombre']) && isset($_POST['tipo']) && isset($_POST['stock']) && isset($_POST['precio'])){


    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $stock =$_POST['stock'];
    $precio =  $_POST['precio'];

    $productonuevo = new producto();
    $productonuevo->codigo=$codigo;
    $productonuevo->nombre=$nombre;
    $productonuevo->tipo=$tipo;
    $productonuevo->stock=$stock;
    $productonuevo->precio=$precio;
    $productonuevo->fechaCreacion = date("Y/m/d");
    $productonuevo->fechaModificacion = "0000-00-00";
 
    
    if(is_numeric($codigo) && is_numeric($stock)){

        $unproducto = producto::TraerUnProducto($codigo);

        if($unproducto == null){

            $UltimoId=$productonuevo->InsertarElProductoParametros();
    
            echo "Ingresado un producto nuevo numero: ", $UltimoId ,"\n";

        }else{
            $unproducto->stock += $stock;
            $unproducto->fechaModificacion = date ("Y-m-d");
            $cantidadDeAfectadas = $unproducto->ModificarProductoParametros();

            print("files afectadas : $cantidadDeAfectadas \n");
            print("Se Actualizo el stock del produco. $unproducto->nombre");
        }

    }else{
        echo "ERROR... codigo o stock no es numerico, no se pudo hacer la operacion";
    }

}
    
 
 ?>