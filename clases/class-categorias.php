<?php
class Categoria
{
    private $id;
    private $nombreCategoria;
    private $icono;
    private $productos;

    public function __construct($id, $nombreCategoria, $icono, $productos)
    {
        $this->id = $id;
        $this->nombreCategoria = $nombreCategoria;
        $this->icono = $icono;
        $this->productos = $productos;
    }

    public function guardarCategoria()
    {
        $contenidoArchivo = file_get_contents("../data/categorias.json");
        $categorias = json_decode($contenidoArchivo, true);
        $categorias[] = array(
            "id" => $this->id,
            "nombreCategoria" => $this->nombreCategoria,
            "icono" => $this->icono,
            "productos" => $this->productos,

        );
        $archivo = fopen("../data/categorias.json", "w");
        fwrite($archivo, json_encode($categorias));
        fclose($archivo);
    }

    public function actualizarCategoria($indice)
    {
        $contenidoArchivo = file_get_contents("../data/categorias.json");
        $categorias = json_decode($contenidoArchivo, true);
        //$usuario = $usuarios[$indice];
        $categoria = array(
            "id" => $this->id,
            "nombreCategoria" => $this->nombreCategoria,
            "icono" => $this->icono,
            "productos" => $this->productos,
        );
        $categorias[$indice] = $categoria;
        $archivo = fopen("../data/categorias.json", "w");
        fwrite($archivo, json_encode($categorias));
        fclose($archivo);

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

    public static function eliminarCategoria($indice)
    {
        $contenidoArchivo = file_get_contents("../data/categorias.json");
        $categorias = json_decode($contenidoArchivo, true);
        array_splice($categorias, $indice, 1);
        $archivo = fopen("../data/categorias.json", "w");
        fwrite($archivo, json_encode($categorias));
        fclose($archivo);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * Get the value of productos
     */
    public function getproductos()
    {
        return $this->productos;
    }

    /**
     * Set the value of productos
     *
     * @return  self
     */
    public function setproductos($productos)
    {
        $this->productos = $productos;

        return $this;
    }
}
