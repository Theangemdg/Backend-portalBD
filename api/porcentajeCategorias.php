<?php

    include_once("../clases/class-porcentajeCategorias.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        
        case 'GET':
            PorcentajeCategorias:: obtenerInfoCategorias();
        break;

    }

?>