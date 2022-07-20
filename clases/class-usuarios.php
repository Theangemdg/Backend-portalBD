<?php


    class Usuario {
        private $nombre;
        private $correo;
        private $contrasena;
        private $direccion;
        private $ordenes;
        private $pedidos;
        private $metodoPago;

        public function __construct($nombre,$correo,$contrasena,$direccion,$ordenes,$pedidos,$metodoPago){
            $this->nombre = $nombre;
            $this->correo = $correo;
            $this->contrasena = $contrasena;
            $this->direccion = $direccion;
            $this->ordenes = $ordenes;
            $this->pedidos = $pedidos;
            $this->metodoPago = $metodoPago;

        }

        public function guardarUsuarios(){
            $contenidoArchivo =  file_get_contents("../data/usuarios.json");
            $usuarios = json_decode($contenidoArchivo, true);
            $usuarios[] = array(
                    "nombre"=> $this->nombre,
                    "correo"=> $this->correo,
                    "contrasena"=> $this->contrasena,
                    "direccion"=> $this->direccion,
                    "ordenes"=> $this ->ordenes,
                    "pedidos"=> $this ->pedidos,
                    "metodoPago"=> $this ->metodoPago,

            );
            $archivo = fopen("../data/usuarios.json","w");
            fwrite($archivo, json_encode($usuarios));
            fclose($archivo);
        }

        public static function obtenerUsuario($indice){
            $contenidoArchivo =  file_get_contents("../data/usuarios.json");
            $usuarios = json_decode($contenidoArchivo, true);
            echo json_encode($usuarios[$indice]);
        }

        public static function obtenerUsuarios(){
                $contenidoArchivo =  file_get_contents("../data/usuarios.json");
                echo $contenidoArchivo ;
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

        /**
         * Get the value of contrasena
         */ 
        public function getContrasena()
        {
                return $this->contrasena;
        }

        /**
         * Set the value of contrasena
         *
         * @return  self
         */ 
        public function setContrasena($contrasena)
        {
                $this->contrasena = $contrasena;

                return $this;
        }

        /**
         * Get the value of ordenes
         */ 
        public function getOrdenes()
        {
                return $this->ordenes;
        }

        /**
         * Set the value of ordenes
         *
         * @return  self
         */ 
        public function setOrdenes($ordenes)
        {
                $this->ordenes = $ordenes;

                return $this;
        }

        /**
         * Get the value of pedidos
         */ 
        public function getPedidos()
        {
                return $this->pedidos;
        }

        /**
         * Set the value of pedidos
         *
         * @return  self
         */ 
        public function setPedidos($pedidos)
        {
                $this->pedidos = $pedidos;

                return $this;
        }

        /**
         * Get the value of metodoPago
         */ 
        public function getMetodoPago()
        {
                return $this->metodoPago;
        }

        /**
         * Set the value of metodoPago
         *
         * @return  self
         */ 
        public function setMetodoPago($metodoPago)
        {
                $this->metodoPago = $metodoPago;

                return $this;
        }

        /**
         * Get the value of direccion
         */ 
        public function getDireccion()
        {
                return $this->direccion;
        }

        /**
         * Set the value of direccion
         *
         * @return  self
         */ 
        public function setDireccion($direccion)
        {
                $this->direccion = $direccion;

                return $this;
        }
    }
?>