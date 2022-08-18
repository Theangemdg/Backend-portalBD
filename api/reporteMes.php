<?php

    include_once("../clases/class-reporteMes.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        
        case 'GET':
            if (isset($_GET['id'])){
                ReporteMes:: obtenerReportes($_GET['id']);
            }else
                ReporteMes:: obtenerLosReportes();
        break;

    }

?>