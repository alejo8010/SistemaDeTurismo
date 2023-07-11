<?php
       include_once("../clase/Conn.php");


    class Destino{
        private $idDestinoTuristico;
        private $nombreDestino;
        private $distrito;
        private $provincia;
        private $departamento;


        
        public function mostrar()
        {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Destino_Turistico";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
        }

        public function guardar(String $nombre, String $departamento, String $provincia, String $distrito)
        {
            $conn = new Conn();
            $conexion = $conn->conectar();
            $sql = "INSERT INTO Destino_Turistico(NombreDestino,Distrito,Provincia,Departamento)
             VALUES ('".$nombre."','".$distrito."','".$provincia."','".$departamento."')";
            $resultado = $conexion->exec($sql);
            $conn->cerrar();
            return $resultado;   
        }
       
    }

?>