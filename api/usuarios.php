
<?php

include_once("../clases/class-usuarios.php");
header("Content-Type: application/json");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);
        $usuario = new Usuario($_POST["id_usuario"], $_POST["nombre"], $_POST["apellido"], $_POST["edad"], $_POST["telefono"], $_POST["contraseña"], $_POST["correo"]);
        $usuario->guardarUsuarios();
        $resultado["mensaje"] = "Guardar usuario, informacion: " . json_encode($_POST);
        echo json_encode($resultado);
        break;
    case 'GET':
        if (isset($_GET['id'])) {
            Usuario::obtenerUsuario($_GET['id']);
        }
        else {
            Usuario::obtenerUsuarios();
        }
        break;
    case 'PUT':

        break;
    case 'DELETE':

        break;
}

?>