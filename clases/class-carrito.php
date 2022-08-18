<?php

class Carrito
{
    private $id_usuario;
    private $id_producto;
    private $cantidad;

    public function __construct($id_usuario, $id_producto, $cantidad)
    {
        $this->id_usuario = $id_usuario;
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
    }

    public function guardarProductoCarrito()
    {

        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("SELECT
                                             *
                                        FROM portal.carrito
                                        WHERE id_usuario = $this->id_usuario");
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        $parse = json_encode($datos);
        $producto = json_decode($parse, true);

        $conexion = null;
        $consulta = null;
        $alerta = false;

        for ($i = 0; $i < count($producto); $i++) {
            if ($producto[$i]['id_producto'] == $this->id_producto) {
                $nuevaCantidad = $this->cantidad + $producto[$i]['cantidad'];
                $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
                $consulta2 = $conexion->prepare("update portal.carrito SET
                                                    cantidad =  $nuevaCantidad
                                                    WHERE id_producto = $this->id_producto");
                $consulta2->execute();

                $conexion = null;
                $consulta2 = null;
                $producto = null;
                $alerta = true;
                break;
            }
        }

        if ($alerta == false) {
            $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
            $consulta3 = $conexion->prepare("insert into portal.carrito
            values ('$this->id_usuario','$this->id_producto' ,'$this->cantidad')");
            $consulta3->execute();

            $conexion = null;
            $consulta3 = null;
        }

    }

    public static function obtenerproductos($id_usuario)
    {

        $conexion = new PDO("sqlsrv:server=localhost;database=PORTAL", "admin", "portal");
        $consulta = $conexion->prepare("select
                                            c.id_producto
                                            ,p.nombre
                                            ,p.descripcion
                                            ,p.precio
                                            ,c.cantidad
                                            ,p.imagen
                                        from portal.carrito c
                                        inner join portal.productos p
                                        on c.id_producto = p.id_producto
                                        WHERE c.id_usuario = $id_usuario");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($datos);
        $conexion = null;
        $consulta = null;
    }

    public static function eliminarProductoCarrito($id_usuario, $id_producto)
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("delete portal.carrito
                                        WHERE id_usuario = $id_usuario
                                        and id_producto = $id_producto");
        $consulta->execute();

        $conexion = null;
        $consulta = null;
    }

    public static function vaciarCarrito($id_usuario)
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("delete portal.carrito
                                        WHERE id_usuario = $id_usuario");
        $consulta->execute();

        $conexion = null;
        $consulta = null;
    }
}
