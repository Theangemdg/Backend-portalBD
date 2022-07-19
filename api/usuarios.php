<?php

    include_once("../clases/class-usuarios.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'),true);
            $usuario = new Usuario($_POST["nombre"], $_POST["correo"], $_POST["contraseña"], $_POST["latitud"], $_POST["longitud"], $_POST["ordenes"], $_POST["pedidos"], $_POST["metodoPago"]);
            $usuario -> guardarUsuarios();
            $resultado["mensaje"] = "Guardar usuiario, informacion: ".json_encode($_POST);
            echo json_encode($resultado); 
        break;
        case 'GET':
            if (isset($_GET['id'])){
                Usuario::obtenerUsuario($_GET['id']);
            }else{
                Usuario::obtenerUsuarios();
            }
        break;
        case 'PUT':

        break;
        case 'DELETE':

        break;
    }

?>

