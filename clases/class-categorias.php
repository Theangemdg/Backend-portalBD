<?php

    class Categoria {
        private $id;
        private $nombreCategoria;
        private $icono;
        private $empresas;

        public function __construct($id,$nombreCategoria,$icono,$empresas){
            $this->id = $id;
            $this->nombreCategoria = $nombreCategoria;
            $this->icono = $icono;
            $this->empresas = $empresas;
        }


        public function guardarCategoria(){
                $contenidoArchivo =  file_get_contents("../data/categorias.json");
                $categorias = json_decode($contenidoArchivo, true);
                $categorias[] = array(
                        "id"=> $this->id,
                        "nombreCategoria"=> $this->nombreCategoria,
                        "icono"=> $this->icono,
                        "empresas"=> $this ->empresas
 
                );
                $archivo = fopen("../data/categorias.json","w");
                fwrite($archivo, json_encode($categorias));
                fclose($archivo);
        }

        public function actualizarCategoria($indice){
                $contenidoArchivo =  file_get_contents("../data/categorias.json");
                $categorias = json_decode($contenidoArchivo, true);
                //$usuario = $usuarios[$indice];
                $categoria = array(
                        "id"=> $this->id,
                        "nombreCategoria"=> $this->nombreCategoria,
                        "icono"=> $this->icono,
                        "empresas"=> $this ->empresas
                );
                $categorias[$indice] = $categoria;
                $archivo = fopen("../data/categorias.json", "w");
                fwrite($archivo, json_encode($categorias));
                fclose($archivo);
                
        }

        public static function obtenerCategorias(){
            $contenidoArchivo =  file_get_contents("../data/categorias.json");
            echo $contenidoArchivo;
        }

        public static function obtenerCategoria($indice){
            $contenidoArchivo =  file_get_contents("../data/categorias.json");
            $categorias = json_decode($contenidoArchivo, true);
            echo json_encode($categorias[$indice]);
        }

        public static function eliminarCategoria($indice){
                $contenidoArchivo =  file_get_contents("../data/categorias.json");
                $categorias = json_decode($contenidoArchivo, true);
                array_splice($categorias, $indice, 1);
                $archivo = fopen("../data/categorias.json", "w");
                fwrite($archivo, json_encode($categorias));
                fclose($archivo);
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

        /**
         * Get the value of nombreCategoria
         */ 
        public function getNombreCategoria()
        {
                return $this->nombreCategoria;
        }

        /**
         * Set the value of nombreCategoria
         *
         * @return  self
         */ 
        public function setNombreCategoria($nombreCategoria)
        {
                $this->nombreCategoria = $nombreCategoria;

                return $this;
        }

        /**
         * Get the value of icono
         */ 
        public function getIcono()
        {
                return $this->icono;
        }

        /**
         * Set the value of icono
         *
         * @return  self
         */ 
        public function setIcono($icono)
        {
                $this->icono = $icono;

                return $this;
        }

        /**
         * Get the value of empresas
         */ 
        public function getEmpresas()
        {
                return $this->empresas;
        }

        /**
         * Set the value of empresas
         *
         * @return  self
         */ 
        public function setEmpresas($empresas)
        {
                $this->empresas = $empresas;

                return $this;
        }
    }
?>