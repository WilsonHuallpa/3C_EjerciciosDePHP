<?php

class Archivo{

    public static function GuardarJSON($ruta,$aux){
        $archivo = fopen($ruta,'w');
        if(fwrite($archivo,$aux ."\n") > 0){
            return true;
        }
        fclose($archivo);
        return false;
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

}



?>