<?php

    class Orden {
        private $nombreProducto;
        private $imgProducto;
        private $cantidad;
        private $descripcion;
        private $precio;


        public function __construct(
            $nombreProducto,
            $imgProducto,
            $cantidad,
            $descripcion,
            $precio
        ){
            $this->nombreProducto = $nombreProducto;
            $this->imgProducto = $imgProducto;
            $this->cantidad = $cantidad;
            $this->descripcion = $descripcion;
            $this->precio = $precio;
        }

        public function guardarOrden($indice){
            $contenidoArchivo =  file_get_contents("../data/usuarios.json");
            $usuarios = json_decode($contenidoArchivo, true);
            $usuarios[$indice]["ordenes"][] = array(
                    "nombreProducto"=> $this->nombreProducto,
                    "imgProducto"=> $this->imgProducto,
                    "cantidad"=> $this->cantidad,
                    "descripcion"=> $this ->descripcion,
                    "precio"=> $this ->precio

            );
            $archivo = fopen("../data/usuarios.json","w");
            fwrite($archivo, json_encode($usuarios));
            fclose($archivo);
        }

        public static function obtenerOrdenes($indice){
            $contenidoArchivo =  file_get_contents("../data/usuarios.json");
            $usuarios = json_decode($contenidoArchivo, true);
            echo json_encode($usuarios[$indice]["ordenes"]);
        }


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

        /**
         * Get the value of nombreProducto
         */ 
        public function getNombreProducto()
        {
                return $this->nombreProducto;
        }

        /**
         * Set the value of nombreProducto
         *
         * @return  self
         */ 
        public function setNombreProducto($nombreProducto)
        {
                $this->nombreProducto = $nombreProducto;

                return $this;
        }

        /**
         * Get the value of imgProducto
         */ 
        public function getImgProducto()
        {
                return $this->imgProducto;
        }

        /**
         * Set the value of imgProducto
         *
         * @return  self
         */ 
        public function setImgProducto($imgProducto)
        {
                $this->imgProducto = $imgProducto;

                return $this;
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
         * Get the value of descripcion
         */ 
        public function getDescripcion()
        {
                return $this->descripcion;
        }

        /**
         * Set the value of descripcion
         *
         * @return  self
         */ 
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }

        /**
         * Get the value of precio
         */ 
        public function getPrecio()
        {
                return $this->precio;
        }

        /**
         * Set the value of precio
         *
         * @return  self
         */ 
        public function setPrecio($precio)
        {
                $this->precio = $precio;

                return $this;
        }
    }
?>