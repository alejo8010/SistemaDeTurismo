<?php
    include_once("Conn.php");
    class Capacitacion{
        private $idDestinoTuristico;
        private $nombreDestino;
        private $distrito;
        private $provincia;
        private $departamento;


        public function guardar(String $idestablecimiento,String $nombre, String $fecha)
        {
            $conn = new Conexion();
            $conexion = $conn->conectar();
            $sql1 = "INSERT INTO Capacitacion(IdEstablecimiento, NombreCapacitacion, Fecha)
            VALUES (".$idestablecimiento.",'".$nombre."','".$fecha."')";
            $resultado = $conexion->exec($sql);
            $conn->cerrar();
            return $resultado;   
        }
       
    }

?>