<?php



require_once "funciones/borraVenta.php";
require_once "funciones/CunsultarVenta.php";
require_once "funciones/PizzaCargar.php";
require_once "funciones/PizzaConsultar.php";
require_once "funciones/AltaDeVenta.php";
require_once "funciones/DevolverPizza.php";
require_once "funciones/ConsultaCupones.php";
require_once "funciones/ConsultasDevolucion.php";
require_once "funciones/ConsultasEspeciales.php";
require_once "funciones/ModificarDevolucion.php";
require_once "funciones/borraVenta.php";



require_once 'bd.php';
require_once "clases/Archivo.php";


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
            case "ListarCuponPorEstados":
                ListarCuponesYsuEstado();
            break;
            case "ListarCuponPorUsuario":
                ListarCuponesPorUsuario();
            break;
            case "ListarCuponPorFecha":
                ListarCuponesFecha("2021-11-22");
            break;
            case "ListarDevolucionPorEstados":
                ListarDevolucionesCupones();
            break;
            case "ListarDevolucionPorUsuario":
                ListarDevolucionesPorUsurio();
            break;
            case "ListarDevolucionPorFecha":
                ListarDevolucionesFecha("2021-11-25");
            break;
            case "ListarLasVentasBorradas":
                ListarLasVentasBorradas();
            break;
            case "MostrarImagenes":
                if(isset($_GET['parametro'])){
                    MostrarImagenes($_GET['parametro']);
                }
            break;
            case "ListarDevolucionyCupones":
                
                ListarDevolucionyCupones();
                
            break;
        }
        break;

    case 'POST':
        $metodo = $_POST['metodo'];
        switch($metodo){
            case 'altaVenta':
                if(isset($_POST['usuario']) && isset($_POST['mail']) && isset($_POST['sabor']) && isset($_POST['tipo']) && isset($_POST['cantidad']) &&   $_FILES["archivo"] ["error"] == 0){
                    AltaDeVenta($_POST['usuario'],$_POST['mail'],$_POST['sabor'],$_POST['tipo'],$_POST['cantidad'],$_FILES["archivo"]);
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
            case "devolucion";
            
                if(isset($_POST['usuario']) && isset($_POST['numero']) && isset($_POST['causa']) && $_FILES["imagen"] ["error"] == 0){

                    DevolverPizza( $_POST['usuario'],$_POST['numero'],$_POST['causa'],$_FILES["imagen"]);

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

        if(isset($_PUT['numeroPedido']) && isset($_PUT['usuario']) && isset($_PUT['causa'])){ 

            $retorno = ModificarDevolucion($_PUT['numeroPedido'],$_PUT['usuario'], $_PUT['causa']);
            if($retorno != -1){
                echo "Se modifico la devolucion.";

            }else{
                echo "no se pudo modificar";
            }
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

?>