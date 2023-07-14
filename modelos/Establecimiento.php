<?php
       include_once("../clase/Conn.php");
    class establecimiento{
        private $idestablecimientoTuristico;
        private $nombreestablecimiento;
        private $distrito;
        private $provincia;
        private $departamento;

        
        public function mostrar() :PDOStatement
        {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql1 = "SELECT e.*,dt.NombreDestino,dt.Departamento,u.Nombres AS NombresUsuario,u.Apellidos AS ApellidosUsuario,r.Nombres AS NombresResponsable,r.Apellidos AS ApellidosResponsable FROM Establecimiento e
        INNER JOIN Destino_Turistico dt ON e.IdDestinoTuristico = dt.IdDestinoTuristico
        LEFT JOIN Usuario u ON e.IdUsuario = u.IdUsuario 
        LEFT JOIN Responsable r ON e.IdResponsable = r.IdResponsable";
        $resultado = $conexion->query($sql1);
        $conn->cerrar();
        return $resultado;
        }

        public function mostrarResponsable(int $id) :PDOStatement
        {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql1 = "SELECT e.*,dt.NombreDestino,dt.Departamento,u.Nombres AS NombresUsuario,u.Apellidos AS ApellidosUsuario,r.Nombres AS NombresResponsable,r.Apellidos AS ApellidosResponsable FROM Establecimiento e
        INNER JOIN Destino_Turistico dt ON e.IdDestinoTuristico = dt.IdDestinoTuristico
        LEFT JOIN Usuario u ON e.IdUsuario = u.IdUsuario 
        LEFT JOIN Responsable r ON e.IdResponsable = r.IdResponsable
        WHERE r.IdResponsable=".$id;
        $resultado = $conexion->query($sql1);
        $conn->cerrar();
        return $resultado;
        }

        public function guardar(String $nombre, String $direccion, String $iddestino, String $idusuario)
        {
            $conn = new Conn();
            $conexion = $conn->conectar();
            $sql1 = "INSERT INTO Establecimiento(NombreEstablecimiento,Direccion,IdDestinoTuristico,IdUsuario)
             VALUES ('".$nombre."','".$direccion."','".$iddestino."','".$idusuario."')";
            $resultado = $conexion->exec($sql1);
            $conn->cerrar();
            return $resultado;   
        }

        
        public function asignar(int $idestablecimiento, int $idresponsable)
        {
            $conn = new Conn();
            $conexion = $conn->conectar();
            $sql1 = "UPDATE Establecimiento SET IdResponsable =".$idresponsable." ,FechaAsignacion='".date("Y-m-d")."' WHERE IdEstablecimiento=".$idestablecimiento;
            $resultado = $conexion->exec($sql1);
            $conn->cerrar();
            return $resultado;   
        }

        public function editar(int $id, String $nombre, String $direccion, String $iddestino)
        {
            $conn = new Conn();
            $conexion = $conn->conectar();
            $sql1 = "UPDATE Establecimiento SET NombreEstablecimiento = '".$nombre."', 
            Direccion = '".$direccion."'".($iddestino>0?", IdDestinoTuristico = ".$iddestino:"")." WHERE IdEstablecimiento =".$id;
            $resultado = $conexion->exec($sql1);
            $conn->cerrar();
            return $resultado;  
        }
       
    }

?>