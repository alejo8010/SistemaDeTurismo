<?php
    class Conn{
        private $hostname;
        private $usuario;
        private $pass;
        private $conexion;

        public function __construct()
        {
            $this->hostname = "mysql:host=localhost;dbname=turismo";
            $this->usuario = "root";
            $this->pass = "";
        }

        public function conectar()
        {
            $this->conexion = new PDO($this->hostname, $this->usuario, $this->pass);
            return $this->conexion;
        }

        public function cerrar()
        {
            $this->conexion = null;
        }

    }
?>