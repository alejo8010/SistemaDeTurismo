<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/modelos/correo.php");
    class correocontroller{

        public function mostrarRecibidos(int $id): PDOStatement
        {
            $correo = new  correo();
            return $correo -> mostrarRecibidos($id);
        }

        public function mostrarEnviados(int $id): PDOStatement
        {
            $correo = new correo();
            return $correo -> mostrarEnviados($id);
        }

        public function enviarCorreo(int $idremitente, int $iddestinario, String $asunto, String $mensaje){
            $correo = new correo();
            $resultado = $correo->enviarCorreo($idremitente, $iddestinario, $asunto, $mensaje);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }
       
    }

?>