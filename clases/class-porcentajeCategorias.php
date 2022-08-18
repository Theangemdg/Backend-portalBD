<?php
class PorcentajeCategorias{
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
    // public static function obtenerReportes($indice){
    //     $conexion = new PDO("sqlsrv:server=localhost;database=PORTAL", "admin", "portal");
    //     $consulta = $conexion->prepare("
    //         with detalleVenta as (
    //             select 
    //                 o.id_orden,
    //                 od.id_producto,
    //                 od.cantidad,
    //                 u.id_usuario,
    //                 nombre + ' ' + apellido as Nombre,
    //                 YEAR(o.fecha_orden) Año,
    //                 MONTH(o.fecha_orden) Mes,
    //                 o.id_empleado
    //             from portal.usuarios u
    //             inner join portal.orden o
    //             on u.id_usuario = o.id_usuario
    //             inner join portal.ordenDetallada od
    //             on od.id_orden = o.id_orden
    //         ), masConsumido as (
    //             select
    //                 dv.id_producto,
    //                 dv.cantidad,
    //                 p.nombre,
    //                 dv.Año,
    //                 dv.Mes,
    //                 sum(dv.cantidad) over (partition by p. id_producto, dv.mes) conteo
    //             from detalleVenta dv
    //             inner join portal.productos p
    //             on p.id_producto = dv.id_producto
    //         ), reporte as (
    //             select  
    //                 id_producto,
    //                 nombre Nombre,
    //                 Mes,
    //                 conteo CantidadPorMes
    //             from masConsumido 
    //         ), reporteEmpleado as (
    //             select distinct
    //                 dv.id_empleado,
    //                 em.nombre + ' ' +em.apellido NombreEmpleado,
    //                 dv.id_orden,
    //                 dv.Año,
    //                 dv.Mes,
    //                 count(dv.id_orden) over (partition by dv.id_empleado, dv.año, dv.mes) contadorOrdenesPorEmpleado
    //             from detalleVenta dv
    //             inner join portal.empleado em
    //             on em.id_empleado = dv.id_empleado
    //         ), mejorEmpleadoMes as (
    //             select 
    //                 NombreEmpleado,
    //                 id_empleado,
    //                 Año,
    //                 mes,
    //                 max(contadorOrdenesPorEmpleado) OrdenesPorMes
    //             from reporteEmpleado
    //             group by 
    //                 NombreEmpleado,
    //                 id_empleado,
    //                 Año,
    //                 mes
    //         )
    //         select top 1
    //             Año,
    //             me.Mes,
    //             id_producto,
    //             Nombre Producto,
    //             CantidadPorMes,
    //             NombreEmpleado MejorEmpleadoDelMes,
    //             OrdenesPorMes
    //         from reporte re
    //         inner join mejorEmpleadoMes me
    //         on re.Mes = me.mes
    //         where re.Mes =  $indice
    //         order by
    //             me.Mes,
    //             re.CantidadPorMes desc
            
    //         ");
    //     $consulta->execute();

    //     $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
    //     echo json_encode($datos);
    //     $conexion = null;
    //     $consulta = null;
    // }

    public static function obtenerInfoCategorias(){
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("
        with PromedioCategorias as (
            select
                e.descripcion,
                p.nombre productName,
                od.id_producto,
                od.cantidad,
                p.precio,
                (p.precio * od.cantidad) as Total,
                o.fecha_orden fecha_orden,
                c.nombreCategoria
            from portal.orden o
            inner join portal.estado e
            on e.id_estado = o.id_estado
            inner join portal.usuarios u
            on u.id_usuario = o.id_usuario
            inner join portal.ordenDetallada od
            on od.id_orden = o.id_orden
            inner join portal.productos p
            on p.id_producto = od.id_producto
            inner join portal.categoria c
            on p.id_categoria = c.id_categoria
        ), ProductosFiltrados as ( 
            select 
                productName,
                nombreCategoria, 
                cantidad, 
                precio, 
                Total,
                sum(Total) OVER(PARTITION BY nombreCategoria order by nombreCategoria) VentasTotalesPorCategoria, 
                fecha_orden,
                ROW_NUMBER() OVER(PARTITION BY nombreCategoria order by year(fecha_orden)) [Top]
            from PromedioCategorias 
        ), TablaVentasTotales as (
            select *, sum(VentasTotalesPorCategoria) OVER(PARTITION BY year(fecha_orden)) VentasTotales
            from ProductosFiltrados
            where [Top] = 1
        ) select productName, nombreCategoria, VentasTotalesPorCategoria, fecha_orden, round((cast(VentasTotalesPorCategoria as float) / cast(VentasTotales as float))*100, 1) [PorcentajeDeVentasPorCategoria (%)] 
        from TablaVentasTotales;
            
            ");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($datos);
        $conexion = null;
        $consulta = null;
    }
}

?>