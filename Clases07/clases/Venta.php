<?php


class venta{

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

    public function VerificarSiExiteYDescontarStock(&$arrayProd){
        
        $retorno = -1;
        foreach ($arrayProd as &$prod) {
            if($prod["sabor"] === $this->sabor && $prod["tipo"] === $this->tipo){
                
                if($prod["cantidad"] >= $this->cantidad){

                    $prod["cantidad"]=($prod["cantidad"]-$this->cantidad);

                   if(venta::CuponDescuento($this->descuento)){
                        $total =  $this->cantidad * $prod["precio"];
                        $this->total = $total - ($total/10);
                        $retorno = 1;
                   }else{
                        $total =  $this->cantidad * $prod["precio"];
                   }
                    
                }else{
                    $retorno = 0;
                }
            }
        }
        return $retorno;
    }

    public  static function CuponDescuento($id_descuento){

        $array = array();
        if(venta::LeerJson("Archivos/cupon.json", $array)){

            foreach ($array as $value) {
                
                if($value['id'] == $id_descuento){
                    return $value['cupon'];
                }
            }
            echo "no exite el cupon  ";
            return false;
        }
    }


    public static function GuardarJSON($ruta,$aux){
        $archivo = fopen($ruta,'w');
        if(fwrite($archivo,$aux) > 0){
            return true;
        }
        fclose($archivo);
    }


    public static function LeerJson($ruta, &$array){

        if(file_exists($ruta)){
            $data = file_get_contents($ruta);
            if($array = json_decode($data,true)){
                return true;
            }else{
                echo "Error..  no se puede decodificar";
            }
        }
        return false;
    }

    public function MostrarDatos(){

        return $this->mail.",".$this->sabor.",".$this->tipo.",".$this->cantidad. ",".$this->numeroPedido .",".$this->fecha . "," . $this->total  . "," . $this->descuento . "\n";
        
     }
    public function InsertarElVentaParametros()
    {
               $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into venta (numeroPedido,fecha,tipo,cantidad,sabor,mail,total,descuento )values(:numeroPedido,:fecha,:tipo,:cantidad,:sabor,:mail,:total,:descuento)");
               $consulta->bindValue(':numeroPedido',$this->numeroPedido, PDO::PARAM_INT);
               $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
               $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
               $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
               $consulta->bindValue(':sabor', $this->sabor, PDO::PARAM_STR);
               $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
               $consulta->bindValue(':total', $this->total, PDO::PARAM_INT);
               $consulta->bindValue(':descuento', $this->descuento, PDO::PARAM_INT);
               $consulta->execute();		
               return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function SubirAchivo($ruta, $file){
         $Nombre_usuario = explode( '@', $this->mail );

        $nombre_archivo = $this->tipo . $this->sabor . $Nombre_usuario[0] ;
        $fichero_subido = $ruta . $nombre_archivo . ".jpg";

        if (!file_exists($ruta)){
            mkdir($ruta, 0777, true);
        }
        if (move_uploaded_file($file['tmp_name'], $fichero_subido)) {
            echo "El fichero es válido y se subió con éxito.\n";
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



    public static function BorrarVenta($numeroPedido)
    {

           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           $consulta =$objetoAccesoDato->RetornarConsulta("
               delete 
               from venta 				
               WHERE numeroPedido=:numeroPedido");	
               $consulta->bindValue(':numeroPedido',$numeroPedido, PDO::PARAM_INT);		
               $consulta->execute();
               return $consulta->rowCount();

    }

    public static function TraerVenta($numeroPedido)
    {
             $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
             $consulta =$objetoAccesoDato->RetornarConsulta("select id, numeroPedido as numeroPedido, fecha as fecha, tipo as tipo, cantidad as cantidad, sabor as sabor, mail as mail, imagen as imagen from venta  WHERE numeroPedido = ?");
            $consulta->execute(array($numeroPedido));	
            $objeto = $consulta->fetchObject("venta");
           return $objeto;
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
     

    
     public function  MoverArchivoImagen($ruta){

        $archivo_antiguo = $this->imagen;
        $nombre_imagen = explode( '/', $archivo_antiguo);
        $nombre = end($nombre_imagen);
        $archivo_nuevo = $ruta .  $nombre;

        if (!file_exists($ruta)){
            mkdir($ruta, 0777, true);
        }
        return rename($archivo_antiguo, $archivo_nuevo);
     }

}
  
?>