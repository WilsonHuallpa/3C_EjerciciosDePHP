<?php


class pizza{


    public $id;
    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;


    public function __construct ($sabor, $precio, $tipo, $cantidad){
        $this->id = 1;
        $this->sabor = $sabor;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;
     
    }

    public static function GuardarJSON($ruta,$aux){
        $archivo = fopen($ruta,'w');
        if(fwrite($archivo,$aux) > 0){
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

    public function VerificarYModificar(&$arrayPizza){
    
        foreach($arrayPizza as &$prod){
            if($prod["sabor"] == $this->sabor && $prod["tipo"] == $this->tipo){
                $prod["cantidad"]=($prod["cantidad"]+$this->cantidad);
                $prod["precio"] = $this->precio;
                return true;
            }
        }
        return false;
    }

    public function SubirAchivo($ruta, $file){
        
       $nombre_archivo = $this->tipo . $this->sabor ;
       $fichero_subido = $ruta . $nombre_archivo . ".jpg";

       if (!file_exists($ruta)){
           mkdir($ruta, 0777, true);
       }
       if (move_uploaded_file($file['tmp_name'], $fichero_subido)) {
           echo "El fichero es válido y se subió con éxito.\n";
       } else {
           echo "¡Posible ataque de subida de ficheros!\n";
       }
   }

}

?>