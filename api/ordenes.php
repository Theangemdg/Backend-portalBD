<?php

    include_once("../clases/class-ordenes.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'),true);
            $orden = new Orden($_POST["id_usuario"], $_POST["id_empleado"], $_POST["id_tipoEntrega"], $_POST["id_tipoPago"], $_POST["id_estado"], $_POST["fecha_orden"] );
            $orden -> guardarOrden(); 
        break;
        case 'GET':
            if (isset($_GET['id'])){
                Orden::obtenerOrdenes($_GET['id']);
            }else
                Orden::OrdenesTotales();
        break;
        case 'PUT':

        break;
        /*case 'DELETE':
            if(isset($_GET['id']) && isset($_GET['idO'])){
                Orden::eliminarOrden($_GET["id"], $_GET['idO']);
                $resultado["mensaje"] = "Eliminar una orden con el id: ".$_GET['id'];
                echo json_encode($resultado);
            }else if(isset($_GET['id'])){
                Orden::eliminarOrdenes($_GET['id']);
                $resultado["mensaje"] = "Eliminar las ordenes del usaurio con el id: ".$_GET['id'];
                echo json_encode($resultado);
            }
            
        break; */
    }

?>

