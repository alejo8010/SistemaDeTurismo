<?php

require_once "modelos/Conn.php";

class login{
    private $Dni;
    private $Password;
    
    

    

    public function mostrar(){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM usuario";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function mostrarPorId($id){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM usuario WHERE IdUsuario=$id";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function buscarDni(){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM usuario WHERE Dni='".$this->Dni."'";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function guardar(){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO usuario(Dni, Password) 
                VALUES('".$this->Dni."', '".$this->Password."')";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }

    /*public function actualizar($id){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "UPDATE usuario
                SET username='".$this->username."', password='".$this->password."', apellidos='".$this->apellidos."', nombres='".$this->nombres."', tipo='".$this->tipo."', id_escuela=".$this->id_escuela.", email='".$this->email."' 
                WHERE id = $id";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }

    

    public function eliminar($id){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "DELETE FROM usuario WHERE id = $id";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }*/


    public function setDni($Dni){
        $this->Dni = $Dni;
    }

    public function setPassword($Password){
        $this->Password = $Password;
    }

    
}