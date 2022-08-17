<?php

    include_once("../clases/class-categorias.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'),true);
            $categoria = new Categoria($_POST["id_categoria"], $_POST["nombreCategoria"], $_POST["descripcion"], $_POST["cantidad_productos"], $_POST["icono"]);
            $categoria -> guardarCategoria();
            $resultado["mensaje"] = "Guardar categoria, informacion: ".json_encode($_POST);
            echo json_encode($resultado); 
        break;
        case 'GET':
            if (isset($_GET['id'])){
                Categoria::obtenerCategoria($_GET['id']);
            }else{
                Categoria::obtenerCategorias();
            }
        break;
        case 'PUT':
            $_PUT = json_decode(file_get_contents('php://input'),true);
            $categoria = new Categoria($_PUT["id_categoria"], $_PUT["nombreCategoria"], $_PUT["descripcion"], $_PUT["cantidad_productos"], $_PUT["icono"]);
            $categoria->actualizarCategoria($_GET['id']);
            $resultado["mensaje"] = "Actualizar una categoria con el id: ".$_GET['id'].
                                    ", Informacion a actualizar: ".json_encode($_PUT);
            echo json_encode($resultado);
        break;
    }

?>