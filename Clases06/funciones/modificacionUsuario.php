
/*
wilson huallpa

Aplicación No 32(Modificacion BD)
Archivo: ModificacionUsuario.php
método:POST
Recibe los datos del usuario(nombre, clavenueva, clavevieja,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer la modificación,
guardando los datos la base de datos
retorna si se pudo agregar o no.
Solo pueden cambiar la clave

 */

<h1>Aplicacion 32</h1>

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