<?php
class Empleado
{
    private $id_empleado;
    private $id_tipoEmpleado;
    private $nombre;
    private $apellido;
    private $telefono;
    private $edad;
    private $correo;
    private $fechaDeContratacion;

    public function __construct($id_empleado, $id_tipoEmpleado, $nombre, $apellido, $telefono,$edad,$correo,$fechaDeContratacion)
    {
        $this->id_empleado = $id_empleado;
        $this->id_tipoEmpleado = $id_tipoEmpleado;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->edad = $edad;
        $this->correo = $correo;
        $this->fechaDeContratacion = $fechaDeContratacion;
    }

    public function guardarEmpleado()
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("insert into portal.empleado
        values ('$this->id_empleado','$this->id_tipoEmpleado' ,'$this->nombre', '$this->apellido','$this->telefono','$this->edad','$this->correo','$this->fechaDeContratacion')");
        $consulta->execute();

        $conexion = null;
        $consulta = null;

    }

    public function actualizarEmpleado($indice)
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("update portal.empleado SET
        id_tipoEmpleado = '$this->id_tipoEmpleado',
        nombre = '$this->nombre',
        apellido = '$this->apellido',
        telefono = '$this->telefono' ,
        apellido = '$this->edad',
        apellido = '$this->correo',
        apellido = '$this->fechaDeContratacion'
        WHERE id_empleado = $this->id_empleado");
        $consulta->execute();
        
        $conexion = null;
        $consulta = null;

    }

    public static function obtenerEmpleados()
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("SELECT * from portal.empleado");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($datos);
        $conexion = null;
        $consulta = null;
    }

    public static function obtenerEmpleado($indice)
    {
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("SELECT * from portal.empleado where id_empleado = $indice");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        $conexion = null;
        $consulta = null;
        $categoria = json_encode($datos[0]);
        echo $categoria;
    }

}
