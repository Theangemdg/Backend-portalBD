<?php

    class Pedido {
        private $numeroPedido;
        private $usuario;
        private $correo;
        private $fechaPago;
        private $total;
        private $icv;
        private $subTotal;
        private $productos;


        public function __construct(
            $numeroPedido,
            $usuario,
            $correo,
            $fechaPago,
            $total,
            $icv,
            $subTotal,
            $productos
            
        ){
            $this->numeroPedido = $numeroPedido;
            $this->usuario = $usuario;
            $this->correo = $correo;
            $this->fechaPago = $fechaPago;
            $this->total = $total;
            $this->icv = $icv;
            $this->subTotal = $subTotal;
            $this->productos = $productos;
        }

        
        public function guardarPedido($indice){
            $contenidoArchivo =  file_get_contents("../data/usuarios.json");
            $usuarios = json_decode($contenidoArchivo, true);
            $usuarios[$indice]["pedidos"][] = array(
                    "numeroPedido"=> $this->numeroPedido,
                    "usuario"=> $this->usuario,
                    "correo"=> $this->correo,
                    "fechaPago"=> $this ->fechaPago,
                    "total"=> $this ->total,
                    "icv"=> $this ->icv,
                    "subTotal"=> $this ->subTotal,
                    "productos"=> $this ->productos,

            );
            $archivo = fopen("../data/usuarios.json","w");
            fwrite($archivo, json_encode($usuarios));
            fclose($archivo);
        }


        public static function obtenerPedidos($indice){
            $contenidoArchivo =  file_get_contents("../data/usuarios.json");
            $usuarios = json_decode($contenidoArchivo, true);
            echo json_encode($usuarios[$indice]["pedidos"]);
        }

        public static function obtenerPedido($indice, $idProducto){
                $contenidoArchivo =  file_get_contents("../data/usuarios.json");
                $usuarios = json_decode($contenidoArchivo, true);
                echo json_encode($usuarios[$indice]["pedidos"][$idProducto]);
        }

        /**
         * Get the value of numeroPedido
         */ 
        public function getNumeroPedido()
        {
                return $this->numeroPedido;
        }

        /**
         * Set the value of numeroPedido
         *
         * @return  self
         */ 
        public function setNumeroPedido($numeroPedido)
        {
                $this->numeroPedido = $numeroPedido;

                return $this;
        }

        /**
         * Get the value of usuario
         */ 
        public function getUsuario()
        {
                return $this->usuario;
        }

        /**
         * Set the value of usuario
         *
         * @return  self
         */ 
        public function setUsuario($usuario)
        {
                $this->usuario = $usuario;

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
         * Get the value of fechaPago
         */ 
        public function getFechaPago()
        {
                return $this->fechaPago;
        }

        /**
         * Set the value of fechaPago
         *
         * @return  self
         */ 
        public function setFechaPago($fechaPago)
        {
                $this->fechaPago = $fechaPago;

                return $this;
        }

        /**
         * Get the value of total
         */ 
        public function getTotal()
        {
                return $this->total;
        }

        /**
         * Set the value of total
         *
         * @return  self
         */ 
        public function setTotal($total)
        {
                $this->total = $total;

                return $this;
        }

        /**
         * Get the value of icv
         */ 
        public function getIcv()
        {
                return $this->icv;
        }

        /**
         * Set the value of icv
         *
         * @return  self
         */ 
        public function setIcv($icv)
        {
                $this->icv = $icv;

                return $this;
        }

        /**
         * Get the value of subTotal
         */ 
        public function getSubTotal()
        {
                return $this->subTotal;
        }

        /**
         * Set the value of subTotal
         *
         * @return  self
         */ 
        public function setSubTotal($subTotal)
        {
                $this->subTotal = $subTotal;

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
    }


?>