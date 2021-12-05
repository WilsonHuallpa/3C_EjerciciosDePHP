
<?php

class Archivo{



    
    public static function LeerJson($ruta, &$array){

        if(file_exists($ruta)){
            $data = file_get_contents($ruta);
            if($array = json_decode($data,true)){
                return true;
            }else{
                throw new Exception('Error..  no se puede decodificar');
            }
        }else {
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

    public static function VerificarTipoImagen($file){

        $tipoArchivo = pathinfo($file["name"], PATHINFO_EXTENSION);
	    $esImagen = getimagesize($file["tmp_name"]);

	    if($esImagen === FALSE) {
            throw new Exception('¡Solo son permitidas IMAGENES.!');
    	}
    	else {
		    if($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif" && $tipoArchivo != "png") {
                $uploadOk = FALSE;
                throw new Exception('Solo son permitidas imagenes con extensi&oacute;n JPG, JPEG, PNG o GIF.');
		    }
	    }
    }



    public static function MoverArchivoImagen($ruta , $foto){

        $archivo_antiguo = $foto;
        $nombre_imagen = explode( '/', $archivo_antiguo);
        $nombre = end($nombre_imagen);
        $archivo_nuevo = $ruta .  $nombre;

        if (!file_exists($ruta)){
            mkdir($ruta, 0777, true);
        }
        return rename($archivo_antiguo, $archivo_nuevo);
    }


    public static function SubirAchivo($ruta, $file , $dato1, $dato2 ) {

        $nombre_archivo =  $dato1 ."-". $dato2;
        $fichero_subido = $ruta . $nombre_archivo . ".jpg";
    
        if (!file_exists($ruta)){
            mkdir($ruta, 0777, true);
        }
        if (move_uploaded_file($file['tmp_name'], $fichero_subido)) {
                return $fichero_subido;
        }else{
            throw new Exception('¡Posible ataque de subida de ficheros!');
        }
    }



}

?>