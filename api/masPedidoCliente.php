<?php

    include_once("../clases/class-masPedidoCliente.php");
    header("Content-Type: application/json");
    switch($_SERVER['REQUEST_METHOD']){
        
        case 'GET':
            PedidoCliente:: obtenerInfoClientes();
            // if (isset($_GET['id'])){
            //     PedidoCliente::obtenerInfoCliente($_GET['id']);
            // }else
            //     PedidoCliente:: obtenerInfoClientes();
        break;

    }

?>