<?php
class PedidoCliente{
    public static function obtenerInfoClientes(){
        $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
        $consulta = $conexion->prepare("
        with CantidadProductosUsuario as (
            select
                u.nombre userName,
                u.apellido,
                o.id_orden,
                e.id_estado,
                e.descripcion,
                p.nombre productName,
                od.id_producto,
                od.cantidad,
                p.precio,
                o.fecha_orden fecha_orden
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
            select userName, apellido, descripcion, productName, cantidad, precio, (precio * cantidad) as Total,  fecha_orden,
                ROW_NUMBER() OVER(PARTITION BY userName, year(fecha_orden) order by cantidad asc) [Top]
            from CantidadProductosUsuario 
        ) select 
            userName, 
            apellido, 
            descripcion, 
            productName, 
            cantidad, 
            precio, 
            Total, 
            year(fecha_orden) [Year]
        from ProductosFiltrados 
        where [Top] = 1
        group by userName, apellido, descripcion, productName, cantidad, precio, Total, fecha_orden;     
        ");
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($datos);
        $conexion = null;
        $consulta = null;
    }
}
?>