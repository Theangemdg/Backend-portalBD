<?php

    include_once("../clases/class-empleados.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'),true);
            $empleado = new Empleado($_POST["id_empleado"], $_POST["id_tipoEmpleado"], $_POST["nombre"], $_POST["apellido"], $_POST["telefono"], $_POST["edad"], $_POST["correo"], $_POST["fechaDeContratacion"]);
            $empleado -> guardarEmpleado();
            $resultado["mensaje"] = "Guardar empleado, informacion: ".json_encode($_POST);
            echo json_encode($resultado); 
        break;
        case 'GET':
            if (isset($_GET['id'])){
                Empleado::obtenerEmpleados($_GET['id']);
            }else{
                Empleado::obtenerEmpleados();
            }
        break;
        case 'PUT':
            $_PUT = json_decode(file_get_contents('php://input'),true);
            $empleado = new Empleado($_PUT["id_empleado"], $_PUT["id_tipoEmpleado"], $_PUT["nombre"], $_PUT["apellido"], $_PUT["telefono"], $_PUT["edad"], $_PUT["correo"], $_POST["fechaDeContratacion"]);
            $empleado->actualizarEmpleado($_GET['id']);
            $resultado["mensaje"] = "Actualizar un empleado con el id: ".$_GET['id'].
                                    ", Informacion a actualizar: ".json_encode($_PUT);
            echo json_encode($resultado);
        break;
    }

?>