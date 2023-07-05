
<?php

require_once "vistas/login.php";

class ValidarLogin{
    public function login($Dni, $Password){
        $login = new Usuario();
        $login->setDni($Dni);
        $resultado = $login->buscarDni();

        $contador = 0;
        $contraseñadb = null;
        $idUsuario = null;
        foreach($resultado as $login){
            $contador++;
            if($contador>0){
                
                    $hashdb = $login["Password"];
                    $idUsuario = $login["IdUsuario"];

                }
            }
        
        if($contador!=0){
            if(!password_verify($Password, $hashdb)){
                return 0;
            }else{
                session_start();
                $_SESSION["IdUsuario"] = $login;
                return 1;

            }
        }  
        return $contador;
    }
        /*public function guardar (string $nombre, string $email, string $password){
            $usuario = new Usuario();
            $usuario->setNombre($nombre);
            $usuario->setEmail($email);
            $usuario->setPassword(password_hash($password, PASSWORD_BCRYPT));

            return $usuario->guardar();



        }*/
    }