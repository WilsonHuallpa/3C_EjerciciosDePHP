<?php
/*
Aplicación No 23 (Registro JSON)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
crear un dato con la fecha de registro , toma todos los datos y utilizar sus métodos para
poder hacer el alta,
guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
Usuario/Fotos/.
retorna si se pudo agregar o no.

Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario.*/
require_once "usuario.php";

if(isset($_POST['nombre']) && isset($_POST['clave']) && isset($_POST['mail']) && $_FILES["archivo"] ["error"] == 0){

    $name= $_POST['nombre'];
    $password= $_POST['clave'];
    $mail= $_POST['mail'];
    $id = rand(1,10000);
    $fecha = date("Y / m / d");

    $dir_subida = 'Usuario/Fotos/';

    $file = $_FILES["archivo"];

    Usuario::SubirAchivo($dir_subida,$file);
    
    $usuario = new Usuario($name,$password,$mail,$id,$fecha);
    
    if(Usuario::GuardarJSON("Archivos/usuario.json", $usuario)){
        echo "se guardo correctamente";
    }
 
   
}

?>