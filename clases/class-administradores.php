<?php

    class Administrador {
        private $id_administrador;
        private $nombre;
        private $apellido;
        private $telefono;
        private $edad;
        private $correo;
        private $contraseña;


        public function __construct(
                 $id_administrador,
                 $nombre,
                 $apellido,
                 $telefono,
                 $edad,
                 $correo,
                 $contraseña
        ){
            $this->id_administrador = $id_administrador;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
            $this->edad = $edad;
            $this->correo = $correo;
            $this->contraseña = $contraseña;
        }

        public static function obtenerAdministradores(){

                $conexion = new PDO("sqlsrv:server=localhost;database=PORTAL", "admin", "portal");
                $consulta = $conexion->prepare("SELECT * from portal.usuarioAdministrador");
                $consulta->execute();
        
                $datos = $consulta->fetchAll(PDO::FETCH_OBJ);
                echo json_encode($datos);
                $conexion = null;
                $consulta = null;
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
         * Get the value of edad
         */ 
        public function getEdad()
        {
                return $this->edad;
        }

        /**
         * Set the value of edad
         *
         * @return  self
         */ 
        public function setEdad($edad)
        {
                $this->edad = $edad;

                return $this;
        }

        /**
         * Get the value of telefono
         */ 
        public function getTelefono()
        {
                return $this->telefono;
        }

        /**
         * Set the value of telefono
         *
         * @return  self
         */ 
        public function setTelefono($telefono)
        {
                $this->telefono = $telefono;

                return $this;
        }

        /**
         * Get the value of apellido
         */ 
        public function getApellido()
        {
                return $this->apellido;
        }

        /**
         * Set the value of apellido
         *
         * @return  self
         */ 
        public function setApellido($apellido)
        {
                $this->apellido = $apellido;

                return $this;
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
         * Get the value of id_administrador
         */ 
        public function getId_administrador()
        {
                return $this->id_administrador;
        }

        /**
         * Set the value of id_administrador
         *
         * @return  self
         */ 
        public function setId_administrador($id_administrador)
        {
                $this->id_administrador = $id_administrador;

                return $this;
        }
    }
?>