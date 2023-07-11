<?php
       include_once("../clase/Conn.php");
    class Correo{

        public function mostrarRecibidos(int $id) :PDOStatement
        {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql1 = "SELECT c.*, rd.Apellidos AS ApellidosDestinatario, rd.Nombres AS NombresDestinatario,
        rr.Apellidos AS ApellidosRemitente, rr.Nombres AS NombresRemitente FROM Correo c
        LEFT JOIN Responsable rd ON c.IdResponsableDestinatario = rd.IdResponsable
        LEFT JOIN Responsable rr ON c.IdResponsableRemitente = rr.IdResponsable 
        WHERE rd.IdResponsable =".$id;
        $resultado = $conexion->query($sql1);
        $conn->cerrar();
        return $resultado;
        }

        public function mostrarEnviados(int $id) :PDOStatement
        {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql1 = "SELECT c.*, rd.Apellidos AS ApellidosDestinatario, rd.Nombres AS NombresDestinatario,
        rr.Apellidos AS ApellidosRemitente, rr.Nombres AS NombresRemitente FROM Correo c
        LEFT JOIN Responsable rd ON c.IdResponsableDestinatario = rd.IdResponsable
        LEFT JOIN Responsable rr ON c.IdResponsableRemitente = rr.IdResponsable 
        WHERE rr.IdResponsable =".$id;
        $resultado = $conexion->query($sql1);
        $conn->cerrar();
        return $resultado;
        }

        public function enviarCorreo(int $idremitente, int $iddestinario, String $asunto, String $mensaje)
        {
            $conn = new Conn();
            $conexion = $conn->conectar();
            $sql1 = "INSERT INTO Correo (IdResponsableRemitente,IdResponsableDestinatario,Asunto,Cuerpo,Fecha)
            VALUES (".$idremitente.",".$iddestinario.",'".$asunto."','".$mensaje."','".date("Y-m-d")."')";
            $resultado = $conexion->exec($sql1);
            $conn->cerrar();
            return $resultado;   
        }
       
    }

?>