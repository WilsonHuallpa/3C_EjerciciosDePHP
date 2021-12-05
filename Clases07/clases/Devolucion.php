<?php



class Devolucion{

    public $id;
    public $numeroPedido;
    public $causa;
    public $usuario;
    public $imagen;
    public $fecha;
    public $idCupon;
   
  
    public function SubirAchivo($ruta, $file){
        
        $nombre_archivo = $this->numeroPedido ."-" . "devolucion" ;
        $fichero_subido = $ruta . $nombre_archivo . ".jpg";
 
        if (!file_exists($ruta)){
            mkdir($ruta, 0777, true);
        }
        if (move_uploaded_file($file['tmp_name'], $fichero_subido)) {
            $this->imagen = $fichero_subido;
            echo "El fichero es válido y se subió con éxito.\n";
        } else {
            echo "¡Posible ataque de subida de ficheros!\n";
        }
    }

    public function cargarUnoBD()
    {
               $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into devoluciones (id, numeroPedido, causa, usuario, imagen, fecha, idCupon )values( :id, :numeroPedido,:causa,:usuario,:imagen,:fecha,:idCupon)");
               $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
               $consulta->bindValue(':numeroPedido', $this->numeroPedido, PDO::PARAM_STR);
               $consulta->bindValue(':causa', $this->causa, PDO::PARAM_STR);
               $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);
               $consulta->bindValue(':imagen', $this->imagen, PDO::PARAM_STR);
               $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
               $consulta->bindValue(':idCupon', $this->idCupon, PDO::PARAM_INT);
               $consulta->execute();		
               return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }


    public static function obtenerTodos()
    {
             $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
             $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id, numeroPedido, causa, usuario, imagen, fecha, idCupon  FROM devoluciones");
            $consulta->execute();	
            
            $arrayVenta = $consulta->fetchAll(PDO::FETCH_CLASS, "Devolucion");
           return $arrayVenta;
    }

    public static function ListaOrdenadoPorUsuario(){  
 
             $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
             $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id, numeroPedido, causa, usuario, imagen, fecha, idCupon FROM devoluciones  ORDER BY usuario asc");
            $consulta->execute();	
            
            $arrayVenta = $consulta->fetchAll(PDO::FETCH_CLASS, "Devolucion");
           return $arrayVenta;
    }

    public static function ListaPorFecha($fecha){  
 
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id, numeroPedido, causa, usuario, imagen, fecha, idCupon FROM devoluciones WHERE fecha >= :fecha");
        $consulta->bindValue(':fecha',$fecha, PDO::PARAM_STR);
        $consulta->execute();	
        $arrayVenta = $consulta->fetchAll(PDO::FETCH_CLASS, "Devolucion");
      return $arrayVenta;
    }


}
?>