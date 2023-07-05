<?php
    include_once("Conn.php");

    class Correo{



        public function enviarCorreo(int $idremitente, int $iddestinario, String $asunto, String $mensaje)
        {
            $conn = new Conn();
            $conexion = $conn->conectar();
            $sql = "INSERT INTO Correo (IdResponsableRemitente,IdResponsableDestinatario,Asunto,Cuerpo,Fecha)
            VALUES (".$idremitente.",".$iddestinario.",'".$asunto."','".$mensaje."','".date("Y-m-d")."')";
            $resultado = $conexion->exec($sql);
            $conn->cerrar();
            return $resultado;   
        }
       
    }

?>