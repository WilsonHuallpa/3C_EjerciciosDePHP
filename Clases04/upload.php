<?php

$dir_subida = 'archivos-subidos/';
$fichero_subido = $dir_subida . basename($_FILES['archivo']['name']);
// basename devuelve el ultimo conponente de nombre de una ruta.

if (!file_exists($dir_subida)){
    mkdir('archivos-subidos/', 0777, true);
    // intenta crear el directorio especificado por pathname.
    /*
    parametro
    1.la ruta del directorio.
    2.el modo predeterminano es 0777, lo que significa el acceso mas amplio posible.
    3.permite la creacion de directorios anidados especificados en el parametro pathname.
    ejemplo
    if(!mkdir($estructura, 0777, true)) {
    die('Fallo al crear las carpetas...');
    }
    */
}
if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) {
    echo "El fichero es válido y se subió con éxito.\n";
} else {
    echo "¡Posible ataque de subida de ficheros!\n";
}

/*
$dir_subida = 'archivos-subidos/';
$fichero_subido = $dir_subida . basename($_FILES['archivo']['name']);

//if(is_dir) se puede usar tambien.
if (!file_exists($dir_subida)) {
    mkdir('archivos-subidos/', 0777, true);
}

if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) {
    echo "El fichero es válido y se subió con éxito.\n";
} else {
    echo "¡Posible ataque de subida de ficheros!\n";
    echo $_FILES['archivo']['error'];
}
 */
// if(is_dir. $_FILES['archivo']['error']
?>