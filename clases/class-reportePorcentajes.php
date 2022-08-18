<?php
    class ReportePorcentajes {
        private $id_usuario;
        private $Nombre_Apellido;
        private $Tipo_Pago;
        private $Porcentaje;
        private $NOTAS;
      
        public function __construct(
                 $id_usuario,
                 $Nombre_Apellido,
                 $Tipo_Pago,
                 $Porcentaje,
                 $NOTAS
        ){
            $this->id_usuario = $id_usuario;
            $this->Nombre_Apellido = $Nombre_Apellido;
            $this->Tipo_Pago = $Tipo_Pago;
            $this->Porcentaje = $Porcentaje;
            $this->NOTAS = $NOTAS;
        }

        public static function obtenerPorcentajes(){

                $conexion = new PDO("sqlsrv:server=localhost;database=PORTAL", "admin", "portal");
                $consulta = $conexion->prepare("WITH Frecuencia_pagos as(
                                                    select 
                                                        tp.id,
                                                        o.id_usuario,
                                                        o.id_orden,
                                                        concat(u.nombre+' ',u.apellido) Nombre_Apellido,
                                                        tp.descripcion as descripcion
                                                    from portal.orden o
                                                        inner join portal.usuarios u
                                                        on o.id_usuario=u.id_usuario
                                                        inner join portal.tipoPago tp
                                                        on tp.id=o.id_tipoPago
                                                ),Conteo_USO as (--ene este cte se cuentan los tipos de pagos(sea efectivo o tarjeta) asociados a cada cliente o usuario
                                                    select
                                                        id_usuario,
                                                        descripcion,
                                                        Nombre_Apellido,
                                                        count(descripcion) over(partition by id_usuario,id order by id_usuario) as conteo,
                                                        count(id_orden) over (partition by id_usuario) conteo_por_orden,
                                                        ROW_NUMBER() over (partition by id_usuario,id order by id_usuario) as RANGO
                                                    from Frecuencia_pagos
                                                ),Calculo_F as(----se calcula el total de tipos de pago de cada cliente
                                                    select 
                                                        id_usuario,
                                                        Nombre_Apellido,
                                                        descripcion,
                                                        conteo,
                                                        conteo_por_orden,
                                                        RANGO,
                                                        count(conteo) over (partition by id_usuario ) as Conteo_rep
                                                    from Conteo_USO
                                                    group by
                                                        id_usuario,
                                                        Nombre_Apellido,
                                                        descripcion,
                                                        conteo,
                                                        conteo_por_orden,
                                                        RANGO
                                                ), NOTAS2 as (---genera un reporte de los usuarios que podrian obtener o no un beneficio especial en el restaurante por su  porcentaje
                                                    select 
                                                        id_usuario,
                                                        Nombre_Apellido,
                                                        descripcion Tipo_Pago, 
                                                        Conteo_rep,
                                                        conteo_por_orden,
                                                        RANGO,
                                                        ((conteo/cast(Conteo_rep as float)))as porcentaje,
                                                        concat(Nombre_Apellido,' es un usuario con porcentaje bajo de uso de ',descripcion,' al momento de pagar')as NOTA
                                                    from Calculo_F 
                                                    )
                                                    select 
                                                        id_usuario,
                                                        Nombre_Apellido,
                                                        Tipo_Pago,
                                                        porcentaje,
                                                        case 
                                                            when (porcentaje <0.5 or  conteo_por_orden<3)-----segun la cantidad de ordenes asignadas que tenga el cliente y su porcentaje se mostrara este u otro mensaje
                                                            then NOTA 
                                                            else concat(Nombre_Apellido,' es un usuario con mayor porcentaje de uso de  ',Tipo_Pago,' al momento de pagar, es apto para descuentos especiales con dicho tipo de pago') 
                                                        end NOTAS
                                                    from NOTAS2
                                                    where 
                                                        RANGO=1
                                                    order by
                                                        porcentaje desc,id_usuario desc");
                $consulta->execute();
        
                $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
                echo json_encode($datos);
                $conexion = null;
                $consulta = null;
        }
    
    }
?>