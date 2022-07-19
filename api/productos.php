<?php

    include_once("../clases/class-productos.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'),true);
            $producto = new Producto($_POST["nombreProducto"], $_POST["imgProducto"], $_POST["descripcion"], $_POST["precio"]);
            $producto -> guardarProducto($_GET['id'],$_GET['idE']);
            $resultado["mensaje"] = "Guardar producto, informacion: ".json_encode($_POST);
            echo json_encode($resultado); 
        break;
        case 'GET':
            if (isset($_GET['id']) && isset($_GET['idE']) && isset($_GET['idP'])){
                Producto::obtenerProducto($_GET['id'], $_GET['idE'],$_GET['idP']);
            }else if (isset($_GET['id']) && isset($_GET['idE'])){
                Producto::obtenerProductos($_GET['id'], $_GET['idE']);
            }
        break;
        case 'PUT':
            $_PUT = json_decode(file_get_contents('php://input'),true);
            $producto = new Producto($_PUT["nombreProducto"], $_PUT["imgProducto"], $_PUT["descripcion"], $_PUT["precio"]);
            $producto->actualizarProducto($_GET['id'], $_GET['idE'], $_GET['idP']);
            $resultado["mensaje"] = "Actualizar un producto con el id: ".$_GET['id'].
                                    ", Informacion a actualizar: ".json_encode($_PUT);
            echo json_encode($resultado);
        break;  
        case 'DELETE':
            Producto::eliminarProducto($_GET["id"], $_GET['idE'], $_GET['idP']);
            $resultado["mensaje"] = "Eliminar un producto con el id: ".$_GET['id'];
            echo json_encode($resultado);
        break;
    }

?>