
<?php
require_once 'clases/Cupon.php';

 function ListarCuponesYsuEstado(){

   $ruta = "archivos/cupones.json";
   
   $arrayCupones = array();

   if(Archivo::LeerJson($ruta,$arrayCupones)){

      foreach ($arrayCupones as $key => $value) {
         $estado;
         if($value["estado"]){
            $estado = "activo";
         }else{
            $estado = "usado";
         }
         echo "numero cupon: " . $value["id"] . "\n";
         echo "estado: " . $estado . "\n";
         echo "usuario: " . $value["usuario"] . "\n \n" ;
      }
   }
   else{
       echo "no exite registro de cupones.";
   }
 }
 function ListarCuponesPorUsuario(){

   $ruta = "archivos/cupones.json";
   
   $arrayCupones = array();

   if(Archivo::LeerJson($ruta,$arrayCupones)){

      array_sort_by($arrayCupones, 'usuario', $order = SORT_ASC);

      foreach ($arrayCupones as $key => $value) {
         $estado;
         if($value["estado"]){
            $estado = "activo";
         }else{
            $estado = "usado";
         }
         echo "numero cupon: " . $value["id"] . "\n";
         echo "estado: " . $estado . "\n";
         echo "usuario: " . $value["usuario"] . "\n \n" ;
      }
   }
   else{
       echo "no exite registro de cupones.";
   }
 }
    
 function ListarCuponesFecha($fecha){
 
   $ruta = "archivos/cupones.json";
   
   $arrayCupones = array();

   if(Archivo::LeerJson($ruta,$arrayCupones)){
      $estado;
      foreach ($arrayCupones as $key => $value) {
         if($value["estado"]){
            $estado = "activo";
         }else{
            $estado = "usado";
         }
         if(FiltarFecha($value["fecha"], $fecha)){
            echo "numero cupon: " . $value["id"] . "\n";
            echo "estado: " . $estado . "\n";
            echo "usuario: " . $value["usuario"] . "\n" ;
            echo "fecha: " . $value["fecha"]. "\n \n";
         }
      }
   }
   else{
       echo "no exite registro de cupones.";
   }
 }

 function FiltarFecha($fecha1, $fecha2 )
 {
   $oldDate = strtotime($fecha1);
   $oldDate2 = strtotime($fecha2);

   if($oldDate > $oldDate2){
      return true;
   }else{
      return false;
   }
    
 }

function array_sort_by(&$arrIni, $col, $order = SORT_ASC)
{
    $arrAux = array();
    foreach ($arrIni as $key=> $row)
    {
        $arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
        $arrAux[$key] = strtolower($arrAux[$key]);
    }
    array_multisort($arrAux, $order, $arrIni);
}


?>