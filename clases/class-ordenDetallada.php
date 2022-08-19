<?php
class OrdenDetallada
{
    private $productos;

    public function __construct(
        $productos
    ) {
        $this->productos = $productos;
    }

    public static function obtenerOrdenDetallada()
    {

        $conexion = new PDO("sqlsrv:server=localhost;database=PORTAL", "admin", "portal");
        $consulta = $conexion->prepare("SELECT
                                                od.id_ordenDetallada,
                                                od.id_orden,
                                                p.nombre as Nombre_Producto,
                                                p.precio as Precio_Producto,
                                                od.cantidad
                                            FROM portal.ordenDetallada od
                                            inner join portal.productos p
                                            on p.id_producto=od.id_producto");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($datos);
        $conexion = null;
        $consulta = null;
    }

    public function guardarOrdenDetallada()
    {
        $products = json_encode($this->productos);
        $datos = json_decode($products, true);

        for ($i = 0; $i < count($datos); $i++) {
                $idOrder = $datos[$i]['id_orden'];
                $idProdu = $datos[$i]['id_producto'];
                $cant = $datos[$i]['cantidad'];
            $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
            $consulta = $conexion->prepare("insert into portal.ordenDetallada
                values ($idOrder,$idProdu,$cant)");
            $consulta->execute();

            $conexion = null;
            $consulta = null;
        }

    }

    /**
     * Get the value of productos
     */
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Set the value of productos
     *
     * @return  self
     */
    public function setProductos($productos)
    {
        $this->productos = $productos;

        return $this;
    }
}
