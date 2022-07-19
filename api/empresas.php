<?php

    include_once("../clases/class-empresas.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'),true);
            $empresa = new Empresa($_POST['id'], $_POST["nombreEmpresa"], $_POST["imagen"], $_POST["logo"], $_POST["descripcion"], $_POST["productos"]);
            $empresa -> guardarEmpresa($_GET['id']);
            $resultado["mensaje"] = "Guardar empresa, informacion: ".json_encode($_POST);
            echo json_encode($resultado); 
        break;
        case 'GET':
            if (isset($_GET['id']) && isset($_GET['idE'])){
                Empresa::obtenerEmpresa($_GET['id'], $_GET['idE']);
            }else if (isset($_GET['id'])){
                Empresa::obtenerEmpresas($_GET['id']);
            }
        break;
        case 'PUT':
            $_PUT = json_decode(file_get_contents('php://input'),true);
            $empresa = new Empresa($_PUT['id'], $_PUT['nombreEmpresa'], $_PUT['imagen'], $_PUT['logo'], $_PUT['descripcion'],  $_PUT['productos']);
            $empresa->actualizarEmpresa($_GET['id'], $_GET['idE']);
            $resultado["mensaje"] = "Actualizar una empresa con el id: ".$_GET['id'].
                                    ", Informacion a actualizar: ".json_encode($_PUT);
            echo json_encode($resultado);
        break;  
        case 'DELETE':
            Empresa::eliminarEmpresa($_GET["id"], $_GET['idE']);
            $resultado["mensaje"] = "Eliminar una empresa con el id: ".$_GET['id'];
            echo json_encode($resultado);
        break;
    }

?>