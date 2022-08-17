<?php

    include_once("../clases/class-ordenes.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'),true);
            $orden = new Orden($_POST["nombreProducto"], $_POST["imgProducto"], $_POST["cantidad"], $_POST["descripcion"], $_POST["precio"]);
            $orden -> guardarOrden($_GET['id']);
            $resultado["mensaje"] = "Guardar orden, informacion: ".json_encode($_POST);
            echo json_encode($resultado); 
        break;
        case 'GET':
            if (isset($_GET['id'])){
                Orden::obtenerOrdenes($_GET['id']);
            }
        break;
        case 'PUT':

        break;
        case 'DELETE':
            if(isset($_GET['id']) && isset($_GET['idO'])){
                Orden::eliminarOrden($_GET["id"], $_GET['idO']);
                $resultado["mensaje"] = "Eliminar una orden con el id: ".$_GET['id'];
                echo json_encode($resultado);
            }else if(isset($_GET['id'])){
                Orden::eliminarOrdenes($_GET['id']);
                $resultado["mensaje"] = "Eliminar las ordenes del usaurio con el id: ".$_GET['id'];
                echo json_encode($resultado);
            }
            
        break;
    }

?>

