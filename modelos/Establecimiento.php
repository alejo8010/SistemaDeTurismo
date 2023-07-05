<?php
    include_once("Conn.php");

    
    class Establecimiento{
        private $idestablecimientoTuristico;
        private $nombreestablecimiento;
        private $distrito;
        private $provincia;
        private $departamento;


        public function mostrarResponsable(int $id) 
        {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT e.*,dt.NombreDestino,dt.Departamento,u.Nombres AS NombresUsuario,u.Apellidos AS ApellidosUsuario,r.Nombres AS NombresResponsable,r.Apellidos AS ApellidosResponsable FROM Establecimiento e
        INNER JOIN Destino_Turistico dt ON e.IdDestinoTuristico = dt.IdDestinoTuristico
        LEFT JOIN Usuario u ON e.IdUsuario = u.IdUsuario 
        LEFT JOIN Responsable r ON e.IdResponsable = r.IdResponsable
        WHERE r.IdResponsable=".$id;
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
        }

        public function guardar(String $nombre, String $direccion, String $iddestino, String $idusuario)
        {
            $conn = new Conexion();
            $conexion = $conn->conectar();
            $sql = "INSERT INTO Establecimiento(NombreEstablecimiento,Direccion,IdDestinoTuristico,IdUsuario)
             VALUES ('".$nombre."','".$direccion."','".$iddestino."','".$idusuario."')";
            $resultado = $conexion->exec($sql);
            $conn->cerrar();
            return $resultado;   
        }
       
    }

?>