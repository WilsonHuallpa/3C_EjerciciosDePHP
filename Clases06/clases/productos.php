<?php

class producto {

    public $codigo;
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;
    public $fechaCreacion;
    public $fechaModificacion;


    public static function AltaProductoJS($ruta, $objeto){
        $retorno;
        $array = array();
        if(producto::LeerJson($ruta,$array)){
            if($objeto->VerificarProducto($array)){
                $aux = json_encode($array,true);
                $retorno = "se modifico";
            }else{
                array_push($array,$objeto);
                $aux = json_encode($array,true);
                $retorno = "se agrego";
            }
        }
        else{
            array_push($array,$objeto);
            $aux = json_encode($array,true);
        }
        producto::GuardarJSON($ruta,$aux);

        return $retorno;
    }

    public static function GuardarJSON($ruta,$aux){
        $archivo = fopen($ruta,'w');
        if(fwrite($archivo,$aux ."\n") > 0){
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

    public function VerificarProducto(&$arrayProducto){
    
        foreach($arrayProducto as &$prod){
            if($prod["codigo"] == $this->codigo){
                $prod["stock"]=(string)($prod["stock"]+$this->stock);
                return true;
            }
        }
     
        return false;
    }

    public function Equals($miArray){

        foreach ($miArray as $value) {
            if($value['codigo'] == $this->codigo){
                return true;
            }
        }
        return false;
    }

    public function verificarCodigoBD(){

        $arrayProd = producto::TraerTodoLosProducto();

        foreach ($arrayProd as $prod) {
            if($prod->codigo == $this->codigo){
                return true;
            }
        }
        return false;
    }


    public static function TraerTodoLosProducto()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, codigo_de_barra as codigo, nombre as nombre, tipo as tipo, stock as stock, precio as precio, fecha_de_creacion as fechaCreacion , fecha_de_modificacion  as fechaModificacion from producto");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");		
	}

    public static function DibujarListado($arrayProc){

        print("<ul>");
        foreach($arrayProc as $i => $proc){

                echo "<li> producto ", ($i + 1), "</li>";
                print("<li>". $proc->codigo . "</li>");
                print("<li>". $proc->nombre . "</li>");
                print("<li>".$proc->tipo ."</li>");
                print("<li>".$proc->stock  ."</li>");
                print("<li>".$proc->precio ."</li>");
                print("<li>".$proc->fechaCreacion ."</li>");
                print("<li>".$proc->fechaModificacion ."</li>");
        }
        print("</ul>");
    }


    public static function TraerUnProducto($codigo) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, codigo_de_barra as codigo, nombre as nombre,tipo as tipo, stock as stock, precio as precio, fecha_de_creacion as fechaCreacion, fecha_de_modificacion as fechaModificacion from producto where codigo_de_barra = $codigo");
			$consulta->execute();
			$ProductBuscado= $consulta->fetchObject('producto');
			return $ProductBuscado;					
	}

    public function InsertarElProductoParametros()
    {
               $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (codigo_de_barra,nombre,tipo,stock,precio,fecha_de_creacion,fecha_de_modificacion)values(:codigo,:nombre,:tipo,:stock,:precio,:fechaCreacion,:fechaModificacion)");
               $consulta->bindValue(':codigo',$this->codigo, PDO::PARAM_INT);
               $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
               $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
               $consulta->bindValue(':stock', $this->stock, PDO::PARAM_STR);
               $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
               $consulta->bindValue(':fechaCreacion', $this->fechaCreacion, PDO::PARAM_STR);
               $consulta->bindValue(':fechaModificacion', $this->fechaModificacion, PDO::PARAM_STR);
               $consulta->execute();		
               return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function ModificarProductoParametros()
    {
           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           $consulta =$objetoAccesoDato->RetornarConsulta("
               UPDATE producto
               set codigo_de_barra ='$this->codigo',
               nombre ='$this->nombre',
               tipo ='$this->tipo', 
               stock ='$this->stock', 
               precio ='$this->precio', 
               fecha_de_creacion ='$this->fechaCreacion', 
               fecha_de_modificacion ='$this->fechaModificacion' 
               WHERE codigo_de_barra = '$this->codigo'");
           return $consulta->execute();
    }

    public static function TraerTodoLosProductoDESoASC($orden)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, codigo_de_barra as codigo, nombre as nombre,tipo as tipo, stock as stock, precio as precio, fecha_de_creacion as fechaCreacion, fecha_de_modificacion as fechaModificacion from producto ORDER BY nombre $orden , tipo $orden ");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS,"producto");		
	}

    public function MostrarDatos(){

        return $this->codigo.",".$this->nombre.",".$this->tipo.",".$this->stock. ",".$this->precio.",".$this->fechaCreacion. ",".$this->fechaModificacion . "\n";
     }
}


?>