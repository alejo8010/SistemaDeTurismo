<?php
    include_once("Conn.php");
    class Responsable{
        private $idresponsableTuristico;
        private $nombreresponsable;
        private $distrito;
        private $provincia;
        private $departamento;


        public function guardar(String $dni, String $apellidos, String $nombres, String $password)
        {
            $conn = new Conn();
            $conexion = $conn->conectar();
            $sql = "INSERT INTO Responsable (Dni,Apellidos,Nombres,Password)
             VALUES ('".$dni."','".$apellidos."','".$nombres."','".$password."')";
            $resultado = $conexion->exec($sql);
            $conn->cerrar();
            return $resultado;   
        }

        public function actualizar(int $id, String $dni, String $apellidos, String $nombres, String $password)
        {
            $conn = new Conn();
            $conexion = $conn->conectar();
            $sql = "UPDATE Responsable SET Dni = '".$dni."',Apellidos = '".$apellidos."',
            Nombres = '".$nombres."',Password = '".$password."' WHERE IdResponsable = ".$id;
            $resultado = $conexion->exec($sql);
            $conn->cerrar();
            return $resultado;   
        }
       
    }

?>