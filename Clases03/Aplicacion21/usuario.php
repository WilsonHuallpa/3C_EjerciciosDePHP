
<?php

class Usuario{
    private $nombre;
    private $clave;
    private $mail;
    private $id;
    private $fecha;

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
    public static function LeerArchivoscsv($strArchivo){
        if(($file = fopen($strArchivo,"r")) !== FALSE){

            
            while(($dato = fgetcsv($file,1000,",")) !== FALSE){
                // $numero = count($dato);
                // for ($c=0; $c < $numero; $c++) {
                //     echo $dato[$c] . "<br />\n";
                // }
            }
        }

        fclose($file);
        return $dato;
    }
}
?>