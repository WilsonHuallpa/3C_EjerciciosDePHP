<?php


class venta{

    public $id;
    public $usuario;
    public $mail;
    public $sabor;
    public $tipo;
    public $cantidad;
    public $numeroPedido;
    public $fecha;
    public $total;
    public $descuento;
    public $imagen;


    public function __construct(){}


    public static function VerificarSiexite($arrayVenta, $numero){

        foreach ($arrayVenta as $value) {
       
            if($value->numeroPedido == $numero){
                 return true;
            }
       }
       return false;
    }

    public function DescontarStock(&$arrayProd, $idProducto){
        
        foreach ($arrayProd as &$prod) {
            if($prod["id"] === $idProducto){
                if($prod["cantidad"] >= $this->cantidad){
                    $prod["cantidad"]=($prod["cantidad"]-$this->cantidad);
                    return $prod['precio'];
                }else{
                    throw new Exception('No tiene estock el producto');
                }
            }
        }
        return $retorno;
    }

    public static function VerificarSiExiteProducto($arrayProd , $unaVenta){
        
        foreach ($arrayProd as  $key => $prod) {
            if($prod["sabor"] === $unaVenta->sabor && $prod["tipo"] === $unaVenta->tipo){
               return $prod["id"];
            }
        }
        throw new Exception('Error..  no se encontro el producto');
    }


    public  function AplicarDescuento($precioPro , &$arrayCupon){

        $retorno = 0;
        $total= $this->cantidad * $precioPro;
        $decuento= 0;
        $totalDecuento = 0;
        foreach ($arrayCupon as &$value) {
            if($value['usuario'] == $this->usuario && $value['estado'] == true){

                $descuento = $value["monto"];
                $totalDecuento = $total - (($total*$descuento)/100);
                $value['estado'] = false;
                $retorno = 1;
            }
        }
        if($retorno){
            $this->total = $totalDecuento;
            $this->descuento = $descuento;
        }else{
            $this->total = $total;
            $this->descuento = 0;
        }

        return $retorno;
    }

    public static function TraerVenta($numeroPedido)
    {
             $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
             $consulta =$objetoAccesoDato->RetornarConsulta("select id, numeroPedido as numeroPedido, fecha as fecha, tipo as tipo, cantidad as cantidad, sabor as sabor, mail as mail, imagen as imagen , total as total,  descuento as descuento from venta  WHERE numeroPedido = ?");
            $consulta->execute(array($numeroPedido));	
            $objeto = $consulta->fetchObject("venta");
           return $objeto;
    }

    

    public function MostrarDatos(){

        return $this->mail.",".$this->sabor.",".$this->tipo.",".$this->cantidad. ",".$this->numeroPedido .",".$this->fecha . "," . $this->total  . "," . $this->descuento . "\n";
        
     }
    public function InsertarElVentaParametros()
    {
               $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into venta (numeroPedido,fecha,tipo,cantidad,sabor,mail, usuario, imagen,total,descuento )values(:numeroPedido,:fecha,:tipo,:cantidad,:sabor,:mail,:usuario, :imagen,:total,:descuento)");
               $consulta->bindValue(':numeroPedido',$this->numeroPedido, PDO::PARAM_INT);
               $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
               $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
               $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
               $consulta->bindValue(':sabor', $this->sabor, PDO::PARAM_STR);
               $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
               $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);
               $consulta->bindValue(':imagen', $this->imagen, PDO::PARAM_STR);
               $consulta->bindValue(':total', $this->total, PDO::PARAM_INT);
               $consulta->bindValue(':descuento', $this->descuento, PDO::PARAM_INT);
               $consulta->execute();		
               return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function SubirAchivo($ruta, $file){

         $Nombre_usuario = explode( '@', $this->mail );
         $newDate = date("Y-m-d", strtotime($this->fecha));
        $nombre_archivo = $this->tipo . $this->sabor . $Nombre_usuario[0] . $newDate;
        $fichero_subido = $ruta . $nombre_archivo . ".jpg";

        if (!file_exists($ruta)){
            mkdir($ruta, 0777, true);
        }
       if (move_uploaded_file($file['tmp_name'], $fichero_subido)) {
           $this->imagen = $fichero_subido;
       } else {
           echo "¡Posible ataque de subida de ficheros!\n";
       }
   
    }

    public static function ObteneCantidadDePizzaVendidas($fecha){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT SUM(cantidad) AS Total FROM venta WHERE fecha = ? ");
        $consulta->execute(array($fecha));			
        $retorno = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $retorno[0]["Total"];
    }

    public static function TotalProductoVendidosPorFecha($fecha1 ,$fecha2)
    {
             $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
             $consulta =$objetoAccesoDato->RetornarConsulta("select id, numeroPedido as numeroPedido, fecha as fecha, tipo as tipo, cantidad as cantidad, sabor as sabor, mail as mail from venta WHERE fecha >= ? AND fecha <= ?  ORDER BY sabor ASC ");
            $consulta->execute(array($fecha1, $fecha2));	
            
            $arrayVenta = $consulta->fetchAll(PDO::FETCH_CLASS, "venta");
           return $arrayVenta;
    }

    public static function TraerTodoLasVentasIngresoPorUsuario($mail)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, numeroPedido as numeroPedido, fecha as fecha, tipo as tipo, cantidad as cantidad , sabor as sabor , mail as mail from venta WHERE mail = ? ");
			$consulta->execute(array($mail));			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}

    public static function TraerTodoLasVentasPorSabor($sabor)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, numeroPedido as numeroPedido, fecha as fecha, tipo as tipo, cantidad as cantidad , sabor as sabor , mail as mail from venta WHERE sabor = ? ");
			$consulta->execute(array($sabor));			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}

    public static function ListarVentasBorradas()
	{
            $nulo = "NULL";
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, numeroPedido, fecha, tipo, cantidad , sabor , mail, usuario , imagen, total, descuento, fechaBaja from venta WHERE fechaBaja != ?");
			$consulta->execute(array($nulo));			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}

    public static function ListarVentas()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, numeroPedido, fecha, tipo, cantidad , sabor , mail, usuario , imagen, total, descuento, fechaBaja from venta");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}


    public static function BorrarVenta($unaVenta)
    {
        $objAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objAccesoDato->RetornarConsulta("UPDATE venta SET fechaBaja = :fechaBaja WHERE numeroPedido = :numero");
        $fecha = new DateTime(date("d-m-Y"));
        $consulta->bindValue(':numero', $unaVenta->numeroPedido, PDO::PARAM_INT);
        $consulta->bindValue(':fechaBaja', date_format($fecha, 'Y-m-d H:i:s'));
        $consulta->execute();
    }

     public function ModificarVentaParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update venta 
				set tipo=:tipo,
				cantidad=:cantidad,
				sabor=:sabor,
                mail=:mail
				WHERE numeroPedido=:numeroPedido");
			$consulta->bindValue(':numeroPedido',$this->numeroPedido, PDO::PARAM_INT);
			$consulta->bindValue(':tipo',$this->tipo, PDO::PARAM_STR);
			$consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
			$consulta->bindValue(':sabor', $this->sabor, PDO::PARAM_STR);
			$consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
			return $consulta->execute();
	 }
     
     

}
  
?>