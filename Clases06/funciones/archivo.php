
<?php 

require_once 'bd.php';
require_once 'clases/productos.php';
require_once 'clases/usuario.php';
require_once 'clases/ventas.php';

$desc="DESC";
$asc="ASC";

/*
$array = usuario::TraerTodoLosUsuariosDESoASC($desc);

foreach($array as $user){
    echo $user->MostrarDatos();
}*/

/*
$arrayPro = producto::TraerTodoLosProductoDESoASC($desc);

foreach($arrayPro as $prod){
    echo $prod->MostrarDatos();
}
*/

/*
$arrayVenta= venta::TraerTodoComprasEntredoscandidades(3 , 6);

foreach($arrayVenta as $venta){

    echo $venta->MostrarDatos();
}*/

/*

$cantidad = venta::TotalProductoVendidosPorFecha("2020-07-00" ,"2021-10-10");

echo $cantidad;
*/

/*

$arrayVenta = venta::MostrarProductoEnviados(7);

foreach($arrayVenta as $venta){
    echo $venta->MostrarDatos();
}
*/

/*F. Mostrar los nombres del usuario y los nombres de los productos de cada venta.*/
/*
$arrayVenta = venta::mostrarNombreDeUsuarioYProductos();


    foreach ($arrayVenta as $key => $value) {
        echo "<table>";
        echo "<tr>";
        echo "  <th> venta: " . $key +1 ."</th>";
        echo "</tr>";

        foreach ($value as $k => $v) {
            echo "<tr>";
            echo "<td> " . $k . ' = ' . $v . "</td>";
            echo "</tr>"; 
        }
    }
    echo "</table>";
    */
/*

/*G.Indicar el monto (cantidad * precio) por cada una de las ventas.*/
/*
$arrayVenta = venta::filtrarMontoTotalPorVenta();

var_dump($arrayVenta);
*/

//H. Obtener la cantidad total de un producto (ejemplo:1003) vendido por un usuario(ejemplo: 104).

/*
$array = venta::filtarTotalProductoVendidoPorUsuario(1005,105);

var_dump($array);
*/

//I. Obtener todos los números de los productos vendidos por algún usuario filtrado por localidad (ejemplo: ‘Avellaneda’).

$localidad = "Avellaneda";

$array = venta::filtarProductoPorLocalidad($localidad);


var_dump($array);

/*
$arrayVenta = venta::MostrarVentaEntreFechas("2020-07-19","2021-04-25");
foreach($arrayVenta as $venta){
    echo $venta->MostrarDatos();
}*/

/*
$arrayUser = usuario::ObtenerDatosUsuarioPorletras('n');

foreach($arrayUser as $user){
    echo $user->MostrarDatos();
}*/



?>