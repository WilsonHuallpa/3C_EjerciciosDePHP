<?php

class Cupon{


    public $id;
    public $estado;
    public $fecha;
    public $monto;
    public $usuario;


    public function cargarUnoBD(){  


        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into cupones (id, estado, fecha, monto, usuario)values( :id, :estado,:fecha,:monto,:usuario)");
               $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
               $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
               $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
               $consulta->bindValue(':monto', $this->monto, PDO::PARAM_INT);
               $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);
               $consulta->execute();		
               return $objetoAccesoDato->RetornarUltimoIdInsertado();

    }

    public static function obtenerTodos()
    {
             $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
             $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id, estado ,fecha ,monto , usuario FROM cupones");
            $consulta->execute();	
            
            $arrayVenta = $consulta->fetchAll(PDO::FETCH_CLASS, "Cupon");
           return $arrayVenta;
    }

    public static function ListaOrdenadoPorUsuario(){  
 
             $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
             $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id, estado ,fecha ,monto , usuario FROM cupones  ORDER BY usuario asc");
            $consulta->execute();	
            
            $arrayVenta = $consulta->fetchAll(PDO::FETCH_CLASS, "Cupon");
           return $arrayVenta;
    }

    public static function ListaPorFecha($fecha){  
 
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id, estado ,fecha ,monto , usuario FROM cupones WHERE fecha > :fecha");
        $consulta->bindValue(':fecha',$fecha, PDO::PARAM_STR);
        $consulta->execute();	
        $arrayVenta = $consulta->fetchAll(PDO::FETCH_CLASS, "Cupon");
      return $arrayVenta;
    }


    
}


?>