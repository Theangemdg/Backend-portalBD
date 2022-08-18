<?php

include_once "../clases/class-productos.php";
header("Content-Type: application/json");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);
        $producto = new Producto($_POST["id_producto"], $_POST["nombre"], $_POST["descripcion"], $_POST["precio"], $_POST["id_categoria"], $_POST["imagen"]);
        $producto->guardarProducto($_GET['id']);
        $resultado["mensaje"] = "Guardar producto, informacion: " . json_encode($_POST);
        echo json_encode($resultado);
        break;
    case 'GET':
        if (isset($_GET['id']) && isset($_GET['idP'])) {
            Producto::obtenerProducto($_GET['id'], $_GET['idP']);
        } else if (isset($_GET['id'])) {
            Producto::obtenerProductos($_GET['id']);
        }
        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $producto = new Producto($_PUT["id_producto"], $_PUT["nombre"], $_PUT["descripcion"], $_PUT["precio"], $_PUT["id_categoria"], $_PUT["imagen"]);
        $producto->actualizarProducto($_GET['id'], $_GET['idP']);
        $resultado["mensaje"] = "Actualizar un producto con el id: " . $_GET['idP'] .
        ", Informacion a actualizar: " . json_encode($_PUT);
        echo json_encode($resultado);
        break;
    case 'DELETE':
        Producto::eliminarProducto($_GET["id"], $_GET['idP']);
        $resultado["mensaje"] = "Eliminar un producto con el id: " . $_GET['idP'];
        echo json_encode($resultado);
        break;
}
