
<?php

class Usuario{
    private $nombre;
    private $clave;
    private $mail;

    public function __construct($n,$c,$m){
        $this->nombre = $n;
        $this->clave = $c;
        $this->mail = $m;
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
}
?>