
 <?php 
require_once 'bd.php';
require_once 'clases/usuario.php';


    if(isset($_POST['clave']) && isset($_POST['mail'])){

        $clave = $_POST['clave'];
        $mail = $_POST['mail'];

        $usuario = new usuario();
        $usuario->clave = $clave;
        $usuario->mail = $mail;

        $arrayUsser = usuario::TraerTodoLosUsuario();

        $retorno = $usuario->Login($arrayUsser);

        echo $retorno;
    }
?>