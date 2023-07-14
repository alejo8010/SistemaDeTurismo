<?php
       include_once("../clase/Conn.php");


    class capacitacion{

        private $idDestinoTuristico;
        private $nombreDestino;
        private $distrito;
        private $provincia;
        private $departamento;

        
        public function mostrar(int $id) :PDOStatement
        {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql1 = "SELECT c.*,e.NombreEstablecimiento,dt.NombreDestino,dt.Departamento FROM Capacitacion c
        INNER JOIN Establecimiento e ON e.IdEstablecimiento = c.IdEstablecimiento
        INNER JOIN Destino_Turistico dt on e.IdDestinoTuristico = dt.IdDestinoTuristico
        INNER JOIN Responsable r ON e.IdResponsable = r.IdResponsable
        WHERE r.IdResponsable =".$id;
        $resultado = $conexion->query($sql1);
        $conn->cerrar();
        return $resultado;
        }

        public function guardar(String $idestablecimiento,String $nombre, String $fecha)
        {
            $conn = new Conn();
            $conexion = $conn->conectar();
            $sql1 = "INSERT INTO Capacitacion(IdEstablecimiento, NombreCapacitacion, Fecha)
            VALUES (".$idestablecimiento.",'".$nombre."','".$fecha."')";
            $resultado = $conexion->exec($sql1);
            $conn->cerrar();
            return $resultado;   
        }
       
    }

?>