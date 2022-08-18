<?php
    include_once("../clases/class-reportePorcentajes.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
        break;
        case 'GET':
            ReportePorcentajes::obtenerPorcentajes();
        break;
        case 'PUT':
        break;
        case 'DELETE':
        break;
    }
?>