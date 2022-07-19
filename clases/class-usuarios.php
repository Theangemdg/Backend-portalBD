<?php


    class Usuario {
        private $nombre;
        private $correo;
        private $contraseña;
        private $latitud;
        private $longitud;
        private $ordenes;
        private $pedidos;
        private $metodoPago;

        public function __construct($nombre,$correo,$contraseña,$latitud,$longitud,$ordenes,$pedidos,$metodoPago){
            $this->nombre = $nombre;
            $this->correo = $correo;
            $this->contraseña = $contraseña;
            $this->latitud = $latitud;
            $this->longitud = $longitud;
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
                    "contraseña"=> $this->contraseña,
                    "latitud"=> $this ->latitud,
                    "longitud"=> $this ->longitud,
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
         * Get the value of latitud
         */ 
        public function getLatitud()
        {
                return $this->latitud;
        }

        /**
         * Set the value of latitud
         *
         * @return  self
         */ 
        public function setLatitud($latitud)
        {
                $this->latitud = $latitud;

                return $this;
        }

        /**
         * Get the value of longitud
         */ 
        public function getLongitud()
        {
                return $this->longitud;
        }

        /**
         * Set the value of longitud
         *
         * @return  self
         */ 
        public function setLongitud($longitud)
        {
                $this->longitud = $longitud;

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
    }
?>