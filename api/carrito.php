<?php

include_once "../clases/class-carrito.php";
header("Content-Type: application/json");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);
        $carrito = new Carrito($_POST["id_usuario"], $_POST["id_producto"], $_POST["cantidad"]);
        $carrito->guardarProductoCarrito();
        $resultado["mensaje"] = "Guardar producto al carrito, informacion: " . json_encode($_POST);
        echo json_encode($resultado);
        break;
    case 'GET':
        Carrito::obtenerproductos($_GET['id']);
        break;
    case 'DELETE':
        if (isset($_GET['id']) && isset($_GET['idP'])){
            Carrito::eliminarProductoCarrito($_GET["id"], $_GET['idP']);
            $resultado["mensaje"] = "Eliminar un producto de carrito con el id: " . $_GET['idP'];
            echo json_encode($resultado);
        }else{
            Carrito::vaciarCarrito($_GET["id"]);
            $resultado["mensaje"] = "se vacio el carrito de usuario con el  id: " . $_GET['id'];
            echo json_encode($resultado);
        }
        break;
}
