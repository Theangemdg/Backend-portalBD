<?php

    include_once("../clases/class-porcentajeCategorias.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        
        case 'GET':
            if (isset($_GET['id'])){
                PorcentajeCategorias:: obtenerInfoCategoria($_GET['id']);
            }else
                PorcentajeCategorias:: obtenerInfoCategorias();
        break;

    }

?>