<?php
class PorcentajeCategorias{
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
        ) select 
            productName, 
            nombreCategoria, 
            VentasTotalesPorCategoria, 
            year(fecha_orden) [Year], 
            round((cast(VentasTotalesPorCategoria as float) / cast(VentasTotales as float))*100, 1) [PorcentajeDeVentasPorCategoria] 
        from TablaVentasTotales
        group by productName, nombreCategoria, fecha_orden, VentasTotalesPorCategoria, VentasTotales;
            
            ");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($datos);
        $conexion = null;
        $consulta = null;
    }
}

?>