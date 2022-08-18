<?php
    class OrdenDetallada {
        private $id_ordenDetallada;
        private $id_orden;
        private $id_producto;
        private $cantidad;
      
        public function __construct(
                 $id_ordenDetallada,
                 $id_orden,
                 $id_producto,
                 $cantidad
        ){
            $this->id_ordenDetallada = $id_ordenDetallada;
            $this->id_orden = $id_orden;
            $this->id_producto = $id_producto;
            $this->cantidad = $cantidad;
        }

        public static function obtenerOrdenDetallada(){

                $conexion = new PDO("sqlsrv:server=localhost;database=PORTAL", "admin", "portal");
                $consulta = $conexion->prepare("SELECT 
                                                od.id_ordenDetallada,
                                                od.id_orden,
                                                p.nombre as Nombre_Producto,
                                                p.precio as Precio_Producto,
                                                od.cantidad
                                            FROM portal.ordenDetallada od
                                            inner join portal.productos p
                                            on p.id_producto=od.id_producto");
                $consulta->execute();
        
                $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
                echo json_encode($datos);
                $conexion = null;
                $consulta = null;
        }

        public function guardarOrdenDetallada()
        {
            $conexion = new PDO("sqlsrv:server=localhost;database=PORTAL", "admin", "portal");
            $consulta = $conexion->prepare("insert into portal.ordenDetallada
            values ('$this->id_orden' ,'$this->id_producto', '$this->cantidad')");
            $consulta->execute();
    
            $conexion = null;
            $consulta = null;
    
        }

     

        /**
         * Get the value of cantidad
         */ 
        public function getCantidad()
        {
                return $this->cantidad;
        }

        /**
         * Set the value of cantidad
         *
         * @return  self
         */ 
        public function setCantidad($cantidad)
        {
                $this->cantidad = $cantidad;

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
         * Get the value of id_orden
         */ 
        public function getId_orden()
        {
                return $this->id_orden;
        }

        /**
         * Set the value of id_orden
         *
         * @return  self
         */ 
        public function setId_orden($id_orden)
        {
                $this->id_orden = $id_orden;

                return $this;
        }

        /**
         * Get the value of id_ordenDetallada
         */ 
        public function getId_ordenDetallada()
        {
                return $this->id_ordenDetallada;
        }

        /**
         * Set the value of id_ordenDetallada
         *
         * @return  self
         */ 
        public function setId_ordenDetallada($id_ordenDetallada)
        {
                $this->id_ordenDetallada = $id_ordenDetallada;

                return $this;
        }
    }
?>