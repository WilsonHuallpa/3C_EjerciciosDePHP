

<?php 


class usuario {


   public $_fechaRegistro;
   public $_nombre;
   public $_clave;
   public $_mail;
   public $_id;
   public $_destino;

   
   public function __construct($nombre,$clave,$mail,$destino,$id = null,$fechaRegistro = null){

        $this->_nombre = $nombre;
        $this->_clave = $clave;
        $this->_mail = $mail;
        $this->_destino = $destino;
        $this->SetID($id);
        $this->SetFecha($fechaRegistro);
       
    }

    public function Tostring(){

       return $this->_nombre.",".$this->_clave.",".$this->_mail. ",".$this->_fechaRegistro .",".$this->_destino. "\n";
    }

    public static function GuardarJson($userArray){

        //JSON_FORCE_OBJECT fuerza el array a ser traducido en un objeto.
        $json_string = json_encode($userArray);

        $handler = fopen("Archivos/usuarios.json", "a");

        if(fwrite($handler,$json_string . "\n") > 0){
            echo "se guardo el registro";
        }else{
            echo "no se guardo";
        }
        fclose($handler);
    }

    public static function DibujarListado($arrayuser){

        print("<ul>");
        foreach($arrayuser as $i => $user){

                echo "<li> usuario ", ($i + 1), "</li>";
                print("<li>". $user->GetNombre() . "</li>");
                print("<li>".$user->GetClave()."</li>");
                print("<li>".$user->GetMail() ."</li>");
                print("<li>".$user->GetFecha() ."</li>");
                print("<li>".$user->GetID() ."</li>");
                print("<li>".$user->GetDestino() ."</li>");
        }
        print("</ul>");
    }

    public static function VerificarUser($arrayuser, $id){

    }

}

?>
