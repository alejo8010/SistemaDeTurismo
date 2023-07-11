<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/modelos/Correo.php");
    class CorreoController{

        public function mostrarRecibidos(int $id): PDOStatement
        {
            $correo = new  Correo();
            return $correo -> mostrarRecibidos($id);
        }

        public function mostrarEnviados(int $id): PDOStatement
        {
            $correo = new Correo();
            return $correo -> mostrarEnviados($id);
        }

        public function enviarCorreo(int $idremitente, int $iddestinario, String $asunto, String $mensaje){
            $correo = new Correo();
            $resultado = $correo->enviarCorreo($idremitente, $iddestinario, $asunto, $mensaje);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }
       
    }

?>