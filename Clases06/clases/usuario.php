
<?php


class usuario{

    public $nombre;
    public $apellido;
    public $clave;
    public $mail;
    public $fecha;
    public $localidad;

   public function __construct(){}

    public static function AltaCSV($usser){

        if(($file = fopen('Archivos/usuarios.csv', 'a')) == FALSE){
            var_dump(error_get_last());
        }else{
            $ArrayCSV = (array)$usser;
            fputcsv($file, $ArrayCSV);
            echo "exito";
            fclose($file);
        }
    }
    public static function GuardarJSON($ruta, $objeto){

        $elArray = $objeto;
        $array = array();
        if(Usuario::LeerJson($ruta,$array)){
            array_push($array,$objeto);
            $aux = json_encode($array,true);
        }
        else{
            array_push($array,$objeto);
            $aux = json_encode($array,true);
        }
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
    public static function SubirAchivo($ruta, $file){

        $fichero_subido = $ruta . basename($file['name']);

        if (!file_exists($ruta)){
            mkdir($ruta, 0777, true);
        }
        if (move_uploaded_file($file['tmp_name'], $fichero_subido)) {
            echo "El fichero es válido y se subió con éxito.\n";
        } else {
            echo "¡Posible ataque de subida de ficheros!\n";
        }
    }
    public static function ListarArray($array){
        print("<ul>");
        foreach($array as $i => $user){
                echo "<li> usuario ", ($i + 1), "</li>";
                print("<li>". $user["nombre"]. "</li>");
                print("<li>". $user["mail"]. "</li>");
                print("<li>". $user["fecha"]. "</li>");
        }
        print("</ul>");
    }

    public function InsertarElUsuarioParametros() {
               $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,mail,fecha_de_registro,localidad)values(:nombre,:apellido,:clave,:mail,:fecha,:localidad)");

               $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
               $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
               $consulta->bindValue(':clave', $this->clave, PDO::PARAM_INT);
               $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
               $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
               $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
               $consulta->execute();		
               return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function TraerTodoLosUsuario() {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre as nombre, apellido as apellido, clave as clave, mail as mail, fecha_de_registro as fecha, localidad as localidad from usuario");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	}

    public static function DibujarListado($arrayuser){

        print("<ul>");
        foreach($arrayuser as $i => $user){

                echo "<li> usuario ", ($i + 1), "</li>";
                print("<li>". $user->nombre . "</li>");
                print("<li>". $user->apellido . "</li>");
                print("<li>".$user->clave ."</li>");
                print("<li>".$user->mail  ."</li>");
                print("<li>".$user->fecha ."</li>");
                print("<li>".$user->localidad ."</li>");
        }
        print("</ul>");
    }

    public function MostrarDatos(){

        return $this->nombre.",".$this->apellido.",".$this->clave.",".$this->mail. ",".$this->fecha .",".$this->localidad. "\n";
     }


    public static function TraerUnUsuarioIdMail($mail,$clave) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  id as _id, nombre as _nombre, apellido as _apellido, clave as _clave, mail as _mail, fecha_de_registro as _fechaDeRegistro, localidad as _localidad from usuario  WHERE clave=? AND mail=?");
			$consulta->execute(array($clave, $mail));
			$cdBuscado= $consulta->fetchObject('usuario');
      		return $cdBuscado;				

			
	}

    public function Login($array){

        $retorno = "Usuario no registrado";

        foreach ($array as $user) {

            if($user->mail == $this->mail){

                if($user->clave == $this->clave){

                    $retorno = "verificado";

                }else{
                    
                    $retorno = "Error en los datos.";
                }
                break;
            }           
        }
        return $retorno;

    }

    public static function TraerUnUsuario($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id , nombre as nombre, apellido as apellido, clave as clave, mail as mail, fecha_de_registro as fecha, localidad as localidad from usuario where id = $id");
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('usuario');
			return $cdBuscado;					
	}

    public function ModificarUsuarioParametros()
    {
           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           $consulta =$objetoAccesoDato->RetornarConsulta("
               update usuario 
               set clave=:_clave
               WHERE id=:_id");
           $consulta->bindValue(':_id',$this->id, PDO::PARAM_INT);
           $consulta->bindValue(':_clave',$this->clave, PDO::PARAM_INT);
           return $consulta->execute();
    }

    public static function TraerUnUsuarioClaveMail($clave, $mail) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre as nombre, apellido as apellido, clave as clave, mail as mail, fecha_de_registro as fecha, localidad as localidad from usuario where clave = ? AND mail = ?");
			$consulta->execute(array($clave, $mail));
			$cdBuscado= $consulta->fetchObject('usuario');
			return $cdBuscado;					
	}

    public static function TraerTodoLosUsuariosDESoASC($orden)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre as nombre, apellido as apellido, clave as clave, mail as mail, fecha_de_registro as fecha, localidad as localidad from usuario ORDER BY nombre $orden , apellido $orden");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	}
    
}



?>