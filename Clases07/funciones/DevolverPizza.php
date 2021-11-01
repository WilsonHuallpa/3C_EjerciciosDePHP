
5- (2 pts.)DevolverPizza.php Guardar en el archivo (devoluciones.json y cupones.json):
a-Se ingresa el número de pedido y la causa de la devolución. El número de pedido debe existir, se ingresa una
foto del cliente enojado,esto debe generar un cupón de descuento con el 10% de descuento para la próxima
compra.


<?php

require_once 'bd.php';
    require_once 'clases/Pizza.php';
    require_once 'clases/Venta.php';

function DevolverPizza ($numeroPedido, $causa, $file){


    
    $venta = TraerVenta($numeroPedido);

    if($venta != false){

        $devolucion =  new Devolucion($numeroPedido,$causa, $files);

        

    }else{
        echo "el pedido no exite";
    }

    
}

class Devolucion{

    public $numeroPedido;
    public $causa;
    public $files;


    public function __construct ($numero, $causa, $files){

        $this->numeroPedido =$numero;
        $this->causa = $causa;
        $this->fiiles = $files;

    }
}


?>
