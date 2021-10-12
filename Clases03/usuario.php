<?php


class Usuario{

    function __construct($usuario){
        $this->usuario = $usuario;
    }

    public static function MostrarUsuario($usuario){

        echo $usuario;
    }

    public static function CrearUsuario($usuario){

        $nuevoUsuario= new usuario($usuario);

        $nuevoUsuario->GuardarUsuarioCSV();

    }

    public function GuardarUsuarioCSV(){

        $fp = fopen('archivos/usuario.csv', 'a');

        if(!$fp){
            var_dump(error_get_last());
        }else{
            $userArray =(array)$this;
            fputcsv($fp, $userArray);
            echo 'el archivo se guardo ok';
            fclose($fp);
        }
    }

    public static function MostrarTodos(){

        $file = 1;
        if(($ar = fopen('archivos/usuario.csv', 'r')) !== false){
            $data = array();
            while(($data =  fgetcsv($ar,1000, ',')) !== false){
                $numero =  count($data);
                echo "<p> <strong> $numero campo en la linea $file: </strong></p>\n";
                $file++;
                for ($c=0; $c < $numero ; $c++) { 
                    echo $data[$c] ."<br/> \n";
                }
            }
            fclose($ar);
        }
    }
}
?>