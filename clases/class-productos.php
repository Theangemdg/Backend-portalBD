<?php

    class Producto {
        private $id;
        private $nombreProducto;
        private $imgProducto;
        private $descripcion;
        private $precio;

        public function __construct($id,$nombreProducto,$imgProducto,$descripcion,$precio){
                $this->id = $id;
                $this->nombreProducto = $nombreProducto;
                $this->imgProducto = $imgProducto;
                $this->descripcion = $descripcion;
                $this->precio = $precio;
        }


        public function guardarProducto($indice){
            $contenidoArchivo =  file_get_contents("../data/categorias.json");
            $categorias = json_decode($contenidoArchivo, true);
            $categorias[$indice]["productos"][] = array(
                "id"=> $this->id,       
                "nombreProducto"=> $this->nombreProducto,
                "imgProducto"=> $this->imgProducto,
                "descripcion"=> $this->descripcion,
                "precio"=> $this ->precio,

            );
            $archivo = fopen("../data/categorias.json","w");
            fwrite($archivo, json_encode($categorias));
            fclose($archivo);
        }


        public function actualizarProducto($indice,$idProducto){
                $contenidoArchivo =  file_get_contents("../data/categorias.json");
                $categorias = json_decode($contenidoArchivo, true);
                
                $producto = array(
                        "id"=> $this->id, 
                        "nombreProducto"=> $this->nombreProducto,
                        "imgProducto"=> $this->imgProducto,
                        "descripcion"=> $this->descripcion,
                        "precio"=> $this ->precio,
                );
                $categorias[$indice]["productos"][$idProducto] = $producto;
                $archivo = fopen("../data/categorias.json", "w");
                fwrite($archivo, json_encode($categorias));
                fclose($archivo);
                
        }

        public static function obtenerProductos($indice){
            $contenidoArchivo =  file_get_contents("../data/categorias.json");
            $categorias = json_decode($contenidoArchivo, true);
            echo json_encode($categorias[$indice]["productos"]);
        }

        public static function obtenerProducto($indice,$producto){
            $contenidoArchivo =  file_get_contents("../data/categorias.json");
            $categorias = json_decode($contenidoArchivo, true);
            echo json_encode($categorias[$indice]["productos"][$producto]);
        }

        public static function eliminarProducto($indice,$producto){
                $contenidoArchivo =  file_get_contents("../data/categorias.json");
                $categorias = json_decode($contenidoArchivo, true);
                array_splice($categorias[$indice]["productos"], $producto, 1);
                $archivo = fopen("../data/categorias.json", "w");
                fwrite($archivo, json_encode($categorias));
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

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }
    }
?>