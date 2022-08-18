
<?php

class Usuario
{

    private $id_usuario;
    private $nombre;
    private $apellido;
    private $edad;
    private $telefono;
    private $contraseña;
    private $correo;

    public function __construct($id_usuario, $nombre, $apellido, $edad, $telefono, $contraseña, $correo)
    {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->edad = $edad;
        $this->telefono = $telefono;
        $this->contraseña = $contraseña;
        $this->correo = $correo;
    }

    public function guardarUsuarios()
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("insert into portal.usuarios
                values ('$this->id_usuario','$this->nombre' ,'$this->apellido', '$this->edad','$this->telefono','$this->contraseña','$this->correo')");
        $consulta->execute();

        $conexion = null;
        $consulta = null;
    }

    public static function obtenerUsuario($indice)
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("SELECT * from portal.usuarios where id_usuario = $indice");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        $conexion = null;
        $consulta = null;
        $categoria = json_encode($datos[0]);
        echo $categoria;
    }

    public static function obtenerUsuarios()
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("SELECT * from portal.usuarios");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($datos);
        $conexion = null;
        $consulta = null;
    }

    public static function obtenerNumeroUser() {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("select
                                                max(id_usuario) usuarios
                                        from portal.usuarios");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($datos[0]);
        $conexion = null;
        $consulta = null;
    }
    /**
     * Get the value of id_usuario
     */
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     *
     * @return  self
     */
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

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
     * Get the value of apellido
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set the value of apellido
     *
     * @return  self
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get the value of edad
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set the value of edad
     *
     * @return  self
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get the value of telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of contraseña
     */
    public function getContraseña()
    {
        return $this->contraseña;
    }

    /**
     * Set the value of contraseña
     *
     * @return  self
     */
    public function setContraseña($contraseña)
    {
        $this->contraseña = $contraseña;

        return $this;
    }

    /**
     * Get the value of correo
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }
}
?>