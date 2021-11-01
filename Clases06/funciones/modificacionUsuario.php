
 <?php

    require_once 'bd.php';
    require_once 'clases/usuario.php';

    if(isset($_POST['nombre']) && isset($_POST['claveNueva']) && isset($_POST['claveVieja']) && isset($_POST['mail'])){

        $nombre = $_POST['nombre'];
        $claveNueva = $_POST['claveNueva'];
        $claveVieja =$_POST['claveVieja'];
        $mail =  $_POST['mail'];

        $usuario = new usuario();
        $usuario->nombre = $nombre;
        $usuario->clave = $claveVieja;
        $usuario->mail = $mail;


        $arrayUsser = usuario::TraerTodoLosUsuario();

        $retorno = $usuario->login($arrayUsser);

        if($retorno  == "verificado"){

            $usser = usuario::TraerUnUsuarioClaveMail($claveVieja, $mail);

            $usser->clave = $claveNueva;
            $modifaciones =  $usser->ModificarUsuarioParametros();
            print "Se Agrego cambio: $modifaciones Usuario: $nombre";

        }else{
            echo "no se puedo modificar";
        }

    }

 ?>