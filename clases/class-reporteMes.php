<?php
class ReporteMes
{
    private $Año;
    private $Mes;
    private $id_producto;
    private $Producto;
    private $CantidadPorMes;
    private $MejorEmpleadoMes;
    private $OrdenesPorMes;

    public function __construct($Año, $Mes, $id_producto, $Producto, $CantidadPorMes, $MejorEmpleadoMes, $OrdenesPorMes)
    {
        $this->Año = $Año;
        $this->Mes = $Mes;
        $this->id_producto = $id_producto;
        $this->Producto = $Producto;
        $this->CantidadPorMes = $CantidadPorMes;
        $this->MejorEmpleadoMes = $MejorEmpleadoMes;
        $this->OrdenesPorMes = $OrdenesPorMes;
    }
    public static function obtenerReportes($indice)
    {

        $conexion = new PDO("sqlsrv:server=localhost;database=PORTAL", "admin", "portal");
        $consulta = $conexion->prepare("
            with detalleVenta as (
                select 
                    o.id_orden,
                    od.id_producto,
                    od.cantidad,
                    u.id_usuario,
                    nombre + ' ' + apellido as Nombre,
                    YEAR(o.fecha_orden) Año,
                    MONTH(o.fecha_orden) Mes,
                    o.id_empleado
                from portal.usuarios u
                inner join portal.orden o
                on u.id_usuario = o.id_usuario
                inner join portal.ordenDetallada od
                on od.id_orden = o.id_orden
            ), masConsumido as (
                select
                    dv.id_producto,
                    dv.cantidad,
                    p.nombre,
                    dv.Año,
                    dv.Mes,
                    sum(dv.cantidad) over (partition by p. id_producto, dv.mes) conteo
                from detalleVenta dv
                inner join portal.productos p
                on p.id_producto = dv.id_producto
            ), reporte as (
                select  
                    id_producto,
                    nombre Nombre,
                    Mes,
                    conteo CantidadPorMes
                from masConsumido 
            ), reporteEmpleado as (
                select distinct
                    dv.id_empleado,
                    em.nombre + ' ' +em.apellido NombreEmpleado,
                    dv.id_orden,
                    dv.Año,
                    dv.Mes,
                    count(dv.id_orden) over (partition by dv.id_empleado, dv.año, dv.mes) contadorOrdenesPorEmpleado
                from detalleVenta dv
                inner join portal.empleado em
                on em.id_empleado = dv.id_empleado
            ), mejorEmpleadoMes as (
                select 
                    NombreEmpleado,
                    id_empleado,
                    Año,
                    mes,
                    max(contadorOrdenesPorEmpleado) OrdenesPorMes
                from reporteEmpleado
                group by 
                    NombreEmpleado,
                    id_empleado,
                    Año,
                    mes
            )
            select top 1
                Año,
                me.Mes,
                id_producto,
                Nombre Producto,
                CantidadPorMes,
                NombreEmpleado MejorEmpleadoDelMes,
                OrdenesPorMes
            from reporte re
            inner join mejorEmpleadoMes me
            on re.Mes = me.mes
            where re.Mes =  $indice
            order by
                me.Mes,
                re.CantidadPorMes desc
            
            ");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($datos);
        $conexion = null;
        $consulta = null;
    }

    public static function obtenerLosReportes()
    {

        $conexion = new PDO("sqlsrv:server=localhost;database=PORTAL", "admin", "portal");
        $consulta = $conexion->prepare("
            with detalleVenta as (
                select 
                    o.id_orden,
                    od.id_producto,
                    od.cantidad,
                    u.id_usuario,
                    nombre + ' ' + apellido as Nombre,
                    YEAR(o.fecha_orden) Año,
                    MONTH(o.fecha_orden) Mes,
                    o.id_empleado
                from portal.usuarios u
                inner join portal.orden o
                on u.id_usuario = o.id_usuario
                inner join portal.ordenDetallada od
                on od.id_orden = o.id_orden
            ), masConsumido as (
                select
                    dv.id_producto,
                    dv.cantidad,
                    p.nombre,
                    dv.Año,
                    dv.Mes,
                    sum(dv.cantidad) over (partition by p. id_producto, dv.mes) conteo
                from detalleVenta dv
                inner join portal.productos p
                on p.id_producto = dv.id_producto
            ), reporte as (
                select  
                    id_producto,
                    nombre Nombre,
                    Mes,
                    conteo 'Cantidad por mes'
                from masConsumido 
            ), reporteEmpleado as (
                select distinct
                    dv.id_empleado,
                    em.nombre + ' ' +em.apellido NombreEmpleado,
                    dv.id_orden,
                    dv.Año,
                    dv.Mes,
                    count(dv.id_orden) over (partition by dv.id_empleado, dv.año, dv.mes) contadorOrdenesPorEmpleado
                from detalleVenta dv
                inner join portal.empleado em
                on em.id_empleado = dv.id_empleado
            ), mejorEmpleadoMes as (
                select 
                    NombreEmpleado,
                    id_empleado,
                    Año,
                    mes,
                    max(contadorOrdenesPorEmpleado) OrdenesPorMes
                from reporteEmpleado
                group by 
                    NombreEmpleado,
                    id_empleado,
                    Año,
                    mes
            )
            select
                Año,
                me.Mes,
                id_producto,
                Nombre Producto,
                [Cantidad por mes],
                NombreEmpleado MejorEmpleadoDelMes,
                OrdenesPorMes
            from reporte re
            inner join mejorEmpleadoMes me
            on re.Mes = me.mes
            order by
                me.Mes,
                año,
                re.[Cantidad por mes] desc
            
            ");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($datos);
        $conexion = null;
        $consulta = null;
    }

    /**
     * Get the value of Año
     */
    public function getAño()
    {
        return $this->Año;
    }

    /**
     * Set the value of Año
     *
     * @return  self
     */
    public function setAño($Año)
    {
        $this->Año = $Año;

        return $this;
    }

    /**
     * Get the value of Mes
     */
    public function getMes()
    {
        return $this->Mes;
    }

    /**
     * Set the value of Mes
     *
     * @return  self
     */
    public function setMes($Mes)
    {
        $this->Mes = $Mes;

        return $this;
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
     * Get the value of Producto
     */
    public function getProducto()
    {
        return $this->Producto;
    }

    /**
     * Set the value of Producto
     *
     * @return  self
     */
    public function setProducto($Producto)
    {
        $this->Producto = $Producto;

        return $this;
    }

    /**
     * Get the value of CantidadPorMes
     */
    public function getCantidadPorMes()
    {
        return $this->CantidadPorMes;
    }

    /**
     * Set the value of CantidadPorMes
     *
     * @return  self
     */
    public function setCantidadPorMes($CantidadPorMes)
    {
        $this->CantidadPorMes = $CantidadPorMes;

        return $this;
    }

    /**
     * Get the value of MejorEmpleadoMes
     */
    public function getMejorEmpleadoMes()
    {
        return $this->MejorEmpleadoMes;
    }

    /**
     * Set the value of MejorEmpleadoMes
     *
     * @return  self
     */
    public function setMejorEmpleadoMes($MejorEmpleadoMes)
    {
        $this->MejorEmpleadoMes = $MejorEmpleadoMes;

        return $this;
    }

    /**
     * Get the value of OrdenesPorMes
     */
    public function getOrdenesPorMes()
    {
        return $this->OrdenesPorMes;
    }

    /**
     * Set the value of OrdenesPorMes
     *
     * @return  self
     */
    public function setOrdenesPorMes($OrdenesPorMes)
    {
        $this->OrdenesPorMes = $OrdenesPorMes;

        return $this;
    }
}

?>