<?php
    include_once("../clases/class-ordenDetallada.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'),true);
            $ordenDetallada = new OrdenDetallada($_POST["productos"]);
            $ordenDetallada -> guardarOrdenDetallada();
            $resultado["mensaje"] = "Guardar orden detallada, informacion: ".json_encode($_POST);
            echo json_encode($resultado);
        break;
        case 'GET':
            OrdenDetallada::obtenerOrdenDetallada();
        break;
        case 'PUT':
        break;
        case 'DELETE':
        break;
    }
?>