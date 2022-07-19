<?php

    class Empresa {
        private $id;
        private $nombreEmpresa;
        private $imagen;
        private $logo;
        private $descripcion;
        private $productos;
        
        public function __construct($id, $nombreEmpresa, $imagen,$logo,$descripcion, $productos){
            $this->id = $id;
            $this->nombreEmpresa = $nombreEmpresa;
            $this->imagen = $imagen;
            $this->logo = $logo;
            $this->descripcion = $descripcion;
            $this->productos = $productos;
        }


        public function guardarEmpresa($indice){
            $contenidoArchivo =  file_get_contents("../data/categorias.json");
            $categorias = json_decode($contenidoArchivo, true);
            $categorias[$indice]["empresas"][] = array(
                    "id"=> $this->id,
                    "nombreEmpresa"=> $this->nombreEmpresa,
                    "imagen"=> $this->imagen,
                    "logo"=> $this->logo,
                    "descripcion"=> $this ->descripcion,
                    "productos"=> $this ->productos,

            );
            $archivo = fopen("../data/categorias.json","w");
            fwrite($archivo, json_encode($categorias));
            fclose($archivo);
        }


        public function actualizarEmpresa($indice, $idEmpresa){
                $contenidoArchivo =  file_get_contents("../data/categorias.json");
                $categorias = json_decode($contenidoArchivo, true);
                
                $empresa = array(
                        "id"=> $this->id,
                        "nombreEmpresa"=> $this->nombreEmpresa,
                        "imagen"=> $this->imagen,
                        "logo"=> $this->logo,
                        "descripcion"=> $this ->descripcion,
                        "productos"=> $this ->productos,
                );
                $categorias[$indice]["empresas"][$idEmpresa] = $empresa;
                $archivo = fopen("../data/categorias.json", "w");
                fwrite($archivo, json_encode($categorias));
                fclose($archivo);
                
        }

        public static function obtenerEmpresas($indice){
            $contenidoArchivo =  file_get_contents("../data/categorias.json");
            $categorias = json_decode($contenidoArchivo, true);
            echo json_encode($categorias[$indice]);
        }

        public static function obtenerEmpresa($indice, $idEmpresa){
            $contenidoArchivo =  file_get_contents("../data/categorias.json");
            $categorias = json_decode($contenidoArchivo, true);
            echo json_encode($categorias[$indice]["empresas"][$idEmpresa]);
        }

        public static function eliminarEmpresa($indice, $idEmpresa){
                $contenidoArchivo =  file_get_contents("../data/categorias.json");
                $categorias = json_decode($contenidoArchivo, true);
                array_splice($categorias[$indice]["empresas"], $idEmpresa, 1);
                $archivo = fopen("../data/categorias.json", "w");
                fwrite($archivo, json_encode($categorias));
                fclose($archivo);
        }

        

        /**
         * Get the value of nombreEmpresa
         */ 
        public function getNombreEmpresa()
        {
                return $this->nombreEmpresa;
        }

        /**
         * Set the value of nombreEmpresa
         *
         * @return  self
         */ 
        public function setNombreEmpresa($nombreEmpresa)
        {
                $this->nombreEmpresa = $nombreEmpresa;

                return $this;
        }

        /**
         * Get the value of imagen
         */ 
        public function getImagen()
        {
                return $this->imagen;
        }

        /**
         * Set the value of imagen
         *
         * @return  self
         */ 
        public function setImagen($imagen)
        {
                $this->imagen = $imagen;

                return $this;
        }

        /**
         * Get the value of logo
         */ 
        public function getLogo()
        {
                return $this->logo;
        }

        /**
         * Set the value of logo
         *
         * @return  self
         */ 
        public function setLogo($logo)
        {
                $this->logo = $logo;

                return $this;
        }

        /**
         * Get the value of productos
         */ 
        public function getProductos()
        {
                return $this->productos;
        }

        /**
         * Set the value of productos
         *
         * @return  self
         */ 
        public function setProductos($productos)
        {
                $this->productos = $productos;

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