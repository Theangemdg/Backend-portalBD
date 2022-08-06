<?php

    include_once("../clases/class-administradores.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':

        break;
        case 'GET':
            Administrador::obtenerAdministradores();
        break;
        case 'PUT':

        break;
        case 'DELETE':

        break;
    }

?>
