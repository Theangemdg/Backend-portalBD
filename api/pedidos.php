<?php

    include_once("../clases/class-pedidos.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'),true);
            $pedido = new Pedido($_POST["numeroPedido"], $_POST["usuario"], $_POST["correo"], $_POST["fechaPago"], $_POST["total"], $_POST["icv"], $_POST["subTotal"], $_POST["productos"]);
            $pedido -> guardarPedido($_GET['id']);
            $resultado["mensaje"] = "Guardar pedido, informacion: ".json_encode($_POST);
            echo json_encode($resultado); 
        break;
        case 'GET':
            if (isset($_GET['id']) && isset($_GET['idP'])){
                Pedido::obtenerPedido($_GET['id'], $_GET['idP']);
            }else if (isset($_GET['id'])){
                Pedido::obtenerPedidos($_GET['id']);
            }
        break;
        case 'PUT':

        break;  
        case 'DELETE':

        break;
    }

?>