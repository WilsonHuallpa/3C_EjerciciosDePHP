<?php


class venta{

    public $_idUsuario;
    public $_idProducto;
    public $_cantidad;
    public $_fecha;
    public $_id;

    public function __construct(){}
    /*
    public function __construct ($_id, $_codigo, $_idUsuario, $_cantidad){
        $this->id = $_id;
        $this->codigo = $_codigo;
        $this->IdUsuario = $_idUsuario;
        $this->cantidad = $_cantidad; 
    }*/


    public function verificarCodigoProducto($arrayProd){
        
        foreach ($arrayProd as $key => $prod) {
            if($prod["codigo"] == $this->codigo){
                return $key;
            }
        }
        return -1;
    }

    public function verificarIDUsser($arrayUsser){
        
        foreach ($arrayUsser as $key => $usser) {
            if($usser["id"] == $this->IdUsuario){
                return true;
            }
        }
        return false;
    }
    public static function AltaDeVentas($ruta, $objeto){
        $array = array();
        if(Archivo::LeerJson($ruta,$array)){
            array_push($array,$objeto);
            $aux = json_encode($array,true);
        }
        else{
            array_push($array,$objeto);
            $aux = json_encode($array,true);
        }
       return Archivo::GuardarJSON($ruta,$aux);
    }
    
    public function VerificarStockIdUsuario(){
        
    }
    public function ReducirStockDeProducto($array, $index , $item){
        
    }

    public static function TraerTodoLasVentas()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, id_producto as _idProducto, id_usuario as _idUsuario, cantidad as _cantidad, fecha_de_venta as _fecha FROM venta");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}


    
    public static function DibujarListado($arrayVenta){

        print("<ul>");
        foreach($arrayVenta as $i => $venta){

                echo "<li> venta ", ($i + 1), "</li>";
                print("<li>". $venta->_idUsuario . "</li>");
                print("<li>". $venta->_idProducto . "</li>");
                print("<li>".$venta->_cantidad ."</li>");
                print("<li>".$venta->_fecha  ."</li>");
        }
        print("</ul>");
    }



    public function InsertarElVentaParametros()
    {
               $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into venta (id_producto,id_usuario,cantidad,fecha_de_venta)values(:_idProducto,:_idUsuario,:_cantidad,:_fecha)");
               $consulta->bindValue(':_idProducto',$this->_idProducto, PDO::PARAM_INT);
               $consulta->bindValue(':_idUsuario', $this->_idUsuario, PDO::PARAM_INT);
               $consulta->bindValue(':_cantidad', $this->_cantidad, PDO::PARAM_INT);
               $consulta->bindValue(':_fecha', $this->_fecha, PDO::PARAM_STR);
               $consulta->execute();		
               return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function TraerTodoComprasEntredoscandidades($min,$max)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, id_producto as _idProducto, id_usuario as _idUsuario, cantidad as _cantidad, fecha_de_venta as _fecha from venta WHERE cantidad >= $min AND cantidad <=$max ");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}

    public function MostrarDatos(){

        return $this->_idProducto.",".$this->_idUsuario.",".$this->_cantidad.",".$this->_fecha. "\n";
    }

    public static function TotalProductoVendidosPorFecha($fecha1 ,$fecha2)
    {
             $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
             $consulta =$objetoAccesoDato->RetornarConsulta("select id, id_producto as _idProducto, id_usuario as _idUsuario, cantidad as _cantidad, fecha_de_venta as _fecha from venta WHERE fecha_de_venta >= ? AND fecha_de_venta <= ?  ");
            $consulta->execute(array($fecha1, $fecha2));	
            
            $arrayVenta = $consulta->fetchAll(PDO::FETCH_CLASS, "venta");

            $cantidad = 0;

            foreach ($arrayVenta as $venta) {
                $cantidad += $venta->_cantidad;
            }

            return $cantidad;
    }

    public static function MostrarProductoEnviados($numero)
    {
             $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
             $consulta =$objetoAccesoDato->RetornarConsulta("select id, id_producto as _idProducto , id_usuario as _idUsuario, cantidad as _cantidad, fecha_de_venta as _fecha from venta ORDER BY fecha_de_venta LIMIT $numero ");
             //$consulta->execute(array("LIMIT"));
            $consulta->execute();	
            return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");
    }


    public static function mostrarNombreDeUsuarioYProductos(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id_usuario, usuario.nombre as nombreUsser, id_producto, producto.nombre as nombreProd FROM venta , usuario , producto WHERE venta.id_producto = producto.id AND venta.id_usuario = usuario.id");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);

    }

    public static function filtrarMontoTotalPorVenta(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT cantidad , producto.precio , (cantidad * producto.precio ) AS monto FROM venta INNER JOIN producto ON venta.id_producto = producto.id");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function filtarTotalProductoVendidoPorUsuario($idProducto, $idUsuario){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id_producto, SUM(cantidad) as CantidadTotal, id_usuario FROM venta WHERE id_producto = ? AND id_usuario = ?");
        $consulta->execute(array($idProducto,$idUsuario));
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function filtarProductoPorLocalidad($localidad){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT producto.codigo_de_barra as Codigo, usuario.nombre, usuario.localidad FROM usuario INNER JOIN producto INNER JOIN venta ON  producto.id = venta.id_producto AND usuario.id = venta.id_usuario AND usuario.localidad = $localidad ");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);

    }
}






?>