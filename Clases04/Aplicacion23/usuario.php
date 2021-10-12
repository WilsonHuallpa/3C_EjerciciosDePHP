
<?php

class Usuario{
    public $nombre;
    public $clave;
    public $mail;
    public $id;
    public $fecha;

    public function __construct($n,$c,$m,$i,$f){
        $this->nombre = $n;
        $this->clave = $c;
        $this->mail = $m;
        $this->id = $i;
        $this->fecha = $f; 
    }
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
        foreach($arrayuser as $i => $user){

                echo "<li> usuario ", ($i + 1), "</li>";
                print("<li>". $user["nombre"]. "</li>");
        }
        print("</ul>");
    }
}
?>