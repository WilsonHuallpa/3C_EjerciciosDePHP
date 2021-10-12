<?php


// echo 'hola mundo';

var_dump($_POST);

// los imformaciones privadas nunca viajan por la url. 

var_dump($_SERVER['REQUEST_METHOD']);
// todos el datos son parte de la peticion.

if($_SERVER['REQUEST_METHOD'] === "GET"){
    var_dump($_GET);
} else if($_SERVER['REQUEST_METHOD'] === "POST"){
    var_dump($_POST);
}

?>