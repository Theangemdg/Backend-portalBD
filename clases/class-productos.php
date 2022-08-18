<?php

class Producto
{
    private $id_producto;
    private $nombre;
    private $descripcion;
    private $precio;
    private $id_categoria;
    private $imagen;
    private $estado;

    public function __construct($id_producto, $nombre, $descripcion, $precio, $id_categoria, $imagen, $estado)
    {
        $this->id_producto = $id_producto;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->id_categoria = $id_categoria;
        $this->imagen = $imagen;
        $this->estado = $estado;
    }

    public function guardarProducto($indice)
    {

        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("insert into portal.productos
        values ('$this->id_producto','$this->nombre' ,'$this->descripcion', '$this->precio','$this->id_categoria','$this->imagen','$this->estado')");
        $consulta->execute();

        $conexion = null;
        $consulta = null;

    }

    public function actualizarProducto($indice, $idProducto)
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("update portal.productos SET
        id_producto = '$this->id_producto',
        nombre = '$this->nombre',
        descripcion = '$this->descripcion',
        precio = '$this->precio',
        id_categoria = '$this->id_categoria',
        imagen = '$this->imagen',
        estado = '$this->estado'
        WHERE id_producto = $this->id_producto");
        $consulta->execute();

        $conexion = null;
        $consulta = null;

    }

    public static function obtenerProductos($indice)
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("select
                                                *
                                        from portal.productos
                                        where id_categoria = $indice 
                                        and estado = 1  ");
        $consulta->execute();

        $productos = $consulta->fetchAll(PDO::FETCH_OBJ);
        $conexion = null;
        $consulta = null;
        echo json_encode($productos);
    }

    public static function obtenerProducto($indice, $idproducto)
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("SELECT * from portal.productos where id_producto = $idproducto");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        $conexion = null;
        $consulta = null;
        $producto = json_encode($datos[0]);
        echo $producto;
    }

    public static function eliminarProducto($indice, $idproducto)
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("update portal.productos SET
                                            estado = 0
                                            WHERE id_producto = $idproducto");
        $consulta->execute();

        $conexion = null;
        $consulta = null;
    }

    /**
     * Get the value of id_producto
     */
    public function getId_producto()
    {
        return $this->id_producto;
    }

    /**
     * Set the value of id_producto
     *
     * @return  self
     */
    public function setId_producto($id_producto)
    {
        $this->id_producto = $id_producto;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of id_categoria
     */
    public function getId_categoria()
    {
        return $this->id_categoria;
    }

    /**
     * Set the value of id_categoria
     *
     * @return  self
     */
    public function setId_categoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;

        return $this;
    }

    /**
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}
