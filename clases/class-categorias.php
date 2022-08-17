<?php
class Categoria
{
    private $id_categoria;
    private $nombreCategoria;
    private $descripcion;
    private $cantidad_productos;
    private $icono;

    public function __construct($id_categoria, $nombreCategoria, $descripcion, $cantidad_productos, $icono)
    {
        $this->id_categoria = $id_categoria;
        $this->nombreCategoria = $nombreCategoria;
        $this->descripcion = $descripcion;
        $this->cantidad_productos = $cantidad_productos;
        $this->icono = $icono;
    }

    public function guardarCategoria()
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("insert into portal.categoria
        values ('$this->id_categoria','$this->nombreCategoria' ,'$this->descripcion', '$this->cantidad_productos','$this->icono')");
        $consulta->execute();

        $conexion = null;
        $consulta = null;

    }

    public function actualizarCategoria($indice)
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("update portal.categoria SET
        nombreCategoria = '$this->nombreCategoria',
        descripcion = '$this->descripcion',
        cantidad_productos = '$this->cantidad_productos',
        icono = '$this->icono' 
        WHERE id_categoria = $this->id_categoria");
        $consulta->execute();
        
        $conexion = null;
        $consulta = null;

    }

    public static function obtenerCategorias()
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("SELECT * from portal.categoria");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($datos);
        $conexion = null;
        $consulta = null;
    }

    public static function obtenerCategoria($indice)
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("SELECT * from portal.categoria where id_categoria = $indice");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        $conexion = null;
        $consulta = null;
        $categoria = json_encode($datos[0]);
        echo $categoria;
    }

    /**
     * Get the value of icono
     */
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * Set the value of icono
     *
     * @return  self
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;

        return $this;
    }

    /**
     * Get the value of cantidad_productos
     */
    public function getCantidad_productos()
    {
        return $this->cantidad_productos;
    }

    /**
     * Set the value of cantidad_productos
     *
     * @return  self
     */
    public function setCantidad_productos($cantidad_productos)
    {
        $this->cantidad_productos = $cantidad_productos;

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
     * Get the value of nombreCategoria
     */
    public function getNombreCategoria()
    {
        return $this->nombreCategoria;
    }

    /**
     * Set the value of nombreCategoria
     *
     * @return  self
     */
    public function setNombreCategoria($nombreCategoria)
    {
        $this->nombreCategoria = $nombreCategoria;

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
}
