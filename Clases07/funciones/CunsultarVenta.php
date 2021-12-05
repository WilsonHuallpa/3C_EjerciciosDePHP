<?php 

require_once 'clases/Venta.php';
//a- la cantidad de pizzas vendidas en un día en particular, si no se pasa fecha, se muestran las del dia de hoy
function cantidadPizzaVentidad($fecha = false){

    if($fecha != false){
        $total = venta::ObteneCantidadDePizzaVendidas($fecha);
        echo $fecha ."\n";
        echo "Cantidad de pizza vendidas: " . " " . $total;
    }else{
        $fecha =   date("Y/m/d");
        $total = venta::ObteneCantidadDePizzaVendidas($fecha);
        echo $fecha ."\n";
        echo "Cantidad de pizza vendidas :" . " " . $total;
    }
   
}

// b- el listado de ventas entre dos fechas ordenado por sabor.
function ListaVentasPorFehas($fecha1, $fecha2){

    $arrayVenta = venta::TotalProductoVendidosPorFecha($fecha1 ,$fecha2);

    if($arrayVenta != false){
       
        foreach ($arrayVenta as  $venta) {
        
            echo $venta->MostrarDatos();
        }
    }else{
        echo "Error, ";
    }
}

// c- el listado de ventas de un usuario ingresado
function ListadoDeVentasDeUnUsuario($mail)
{
    $array =  venta::TraerTodoLasVentasIngresoPorUsuario($mail);
    var_dump($array);
    
}
// d- el listado de ventas de un sabor ingresado
function listadoDeVentasPorSabor($sabor){
    $array =  venta::TraerTodoLasVentasPorSabor($sabor);
    var_dump($array);
}
?>