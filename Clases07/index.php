<?php

require_once "funciones/ModificarVenta.php";
require_once "funciones/borraVenta.php";
require_once "funciones/CunsultarVenta.php";


require_once "funciones/PizzaCargar.php";
require_once "funciones/PizzaConsultar.php";
require_once "funciones/AltaDeVenta.php";

$method = $_SERVER['REQUEST_METHOD'];


switch ($method) {

    case 'GET':
        $metodo = $_GET['metodo'];
        switch($metodo){
            case "CantidadVendidas":
                cantidadPizzaVentidad();
                break;
            case "ListaPorFecha":
                ListaVentasPorFehas("2021-10-00","2022-10-00");
                break;
            case "ListaPorUsuario":
                ListadoDeVentasDeUnUsuario("wilsonhuallpq@gmai.com");
                break;
            case "ListaPorSabor":
                listadoDeVentasPorSabor("agrio");
                break;
        }
        break;

    case 'POST':
        $metodo = $_POST['metodo'];
        switch($metodo){
            case 'AltasDeVentas':
                if(isset($_POST['mail']) && isset($_POST['sabor']) && isset($_POST['tipo']) && isset($_POST['cantidad']) && isset($_POST['cupon']) &&   $_FILES["archivo"] ["error"] == 0){
                    AltaDeVenta($_POST['mail'],$_POST['sabor'],$_POST['tipo'],$_POST['cantidad'],$_FILES["archivo"], $_POST['cupon']);
                }else{
                    echo "Erro... no se encuetra algunos valores";
                }
                
                break;

            case 'consultar':
                if(isset($_POST['sabor']) && isset($_POST['tipo'])){
                    echo ConsultarPizza($_POST['sabor'],$_POST['tipo']);

                }else{
                    echo "Erro... no se encuetra algunos valores";
                }

                break;
            case "cargar";

                if(isset($_POST['sabor']) && isset($_POST['precio']) && isset($_POST['tipo'])&& isset($_POST['cantidad']) && $_FILES["archivo"] ["error"] == 0){

                    PizzaCarga($_POST['sabor'],$_POST['precio'],$_POST['tipo'],$_POST['cantidad'],$_FILES["archivo"]);
                }else{
                    echo "Erro... no se encuetra algunos valores";
                }
                break;

            default:
                echo "no es ningun metodo";
                break;
        }
        break;

    case 'PUT';

        parse_str(file_get_contents('php://input'), $_PUT);

        if(isset($_PUT['numeroPedido']) && isset($_PUT['mail']) && isset($_PUT['sabor']) && isset($_PUT['tipo']) && isset($_PUT['cantidad'])){ 

            $retorno = ModificarVenta($_PUT['numeroPedido'],$_PUT['mail'],$_PUT['sabor'],$_PUT['tipo'],$_PUT['cantidad']);
            echo $retorno;
        }else{
            echo "Error.. no se encuentra algunos valores..";
        }
        break;

    case 'DELETE':
        parse_str(file_get_contents('php://input'), $_DELETE);

        if(isset($_DELETE['numeroPedido'])){

           echo BorrarVenta($_DELETE['numeroPedido']);
         
         }else { 
             echo "Erro... no se encuetra algunos valores";
         }
        break;
    default:
        echo "se deben ingresar por los metodos GET, POST, PUT, DELETE.";
    break;
    

}




5- (2 pts.)DevolverPizza.php Guardar en el archivo (devoluciones.json y cupones.json):
a-Se ingresa el número de pedido y la causa de la devolución. El número de pedido debe existir, se ingresa una
foto del cliente enojado,esto debe generar un cupón de descuento con el 10% de descuento para la próxima
compra.
6- (2 pts.)ConsultasDevoluciones.php:-
a-Listar las devoluciones con sus cupones.
b-Listar las devoluciones ordenadas por usuarios.
c-Listar las devoluciones ordenadas por fecha.

7- (2 pts.)ConsultasCuponesz.php:-
a-Listar todos los cupones y su estado.
b-Listar todos los cupones ordenados por usuarios.
b-Listar todos los cupones por fecha, desde una fecha en particular.


?>