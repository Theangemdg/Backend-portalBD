<?php

    class Orden {
        private $id_usuario;
        private $id_empleado;
        private $id_tipoEntrega;
        private $id_tipoPago;
        private $id_estado;
        private $fecha_orden;


        public function __construct(
                $id_usuario,
                $id_empleado,
                $id_tipoEntrega,
                $id_tipoPago,
                $id_estado,
                $fecha_orden
        ){
                $this->id_usuario = $id_usuario;
                $this->id_empleado = $id_empleado;
                $this->id_tipoEntrega = $id_tipoEntrega;
                $this->id_tipoPago = $id_tipoPago;
                $this->id_estado = $id_estado;
                $this->fecha_orden = $fecha_orden;

        }
        
        public function guardarOrden(){
                $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
                $consulta = $conexion->prepare("insert into portal.orden
                values ('$this->id_usuario','$this->id_empleado' ,'$this->id_tipoEntrega', '$this->id_tipoPago', '$this->id_estado', '$this->fecha_orden')");
                $consulta->execute();
        
                $conexion = null;
                $consulta = null;
        
        }

        public static function obtenerOrdenes($indice){
                $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
                $consulta = $conexion->prepare("SELECT * from portal.orden where id_usuario = $indice");
                $consulta->execute();
        
                $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
                echo json_encode($datos);
                $conexion = null;
                $consulta = null;
        }

        public static function OrdenesTotales(){
                $conexion = new PDO("sqlsrv:server=localhost;database=Portal", "admin", "portal");
                $consulta = $conexion->prepare("SELECT * from portal.orden");
                $consulta->execute();
        
                $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
                echo json_encode($datos);
                $conexion = null;
                $consulta = null;
        }

        /*
        public static function eliminarOrden($indice, $idOrden){
            $contenidoArchivo =  file_get_contents("../data/usuarios.json");
            $usuarios = json_decode($contenidoArchivo, true);
            array_splice($usuarios[$indice]["ordenes"], $idOrden, 1);
            $archivo = fopen("../data/usuarios.json", "w");
            fwrite($archivo, json_encode($usuarios));
            fclose($archivo);
        }

        public static function eliminarOrdenes($indice){
                $contenidoArchivo =  file_get_contents("../data/usuarios.json");
                $usuarios = json_decode($contenidoArchivo, true); 
                $usuarios[$indice]["ordenes"] = array();
                $archivo = fopen("../data/usuarios.json", "w");
                fwrite($archivo, json_encode($usuarios));
                fclose($archivo);
        }

        */
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
         * Get the value of id_empleado
         */ 
        public function getId_empleado()
        {
                return $this->id_empleado;
        }

        /**
         * Set the value of id_empleado
         *
         * @return  self
         */ 
        public function setId_empleado($id_empleado)
        {
                $this->id_empleado = $id_empleado;

                return $this;
        }

        /**
         * Get the value of id_tipoEntrega
         */ 
        public function getId_tipoEntrega()
        {
                return $this->id_tipoEntrega;
        }

        /**
         * Set the value of id_tipoEntrega
         *
         * @return  self
         */ 
        public function setId_tipoEntrega($id_tipoEntrega)
        {
                $this->id_tipoEntrega = $id_tipoEntrega;

                return $this;
        }

        /**
         * Get the value of id_tipoPago
         */ 
        public function getId_tipoPago()
        {
                return $this->id_tipoPago;
        }

        /**
         * Set the value of id_tipoPago
         *
         * @return  self
         */ 
        public function setId_tipoPago($id_tipoPago)
        {
                $this->id_tipoPago = $id_tipoPago;

                return $this;
        }

        /**
         * Get the value of id_estado
         */ 
        public function getId_estado()
        {
                return $this->id_estado;
        }

        /**
         * Set the value of id_estado
         *
         * @return  self
         */ 
        public function setId_estado($id_estado)
        {
                $this->id_estado = $id_estado;

                return $this;
        }

        /**
         * Get the value of fecha_orden
         */ 
        public function getFecha_orden()
        {
                return $this->fecha_orden;
        }

        /**
         * Set the value of fecha_orden
         *
         * @return  self
         */ 
        public function setFecha_orden($fecha_orden)
        {
                $this->fecha_orden = $fecha_orden;

                return $this;
        }
    }
?>