<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/clase/Conn.php");

function LoginUsuario($dni,$password){
    $conn = new Conn();
    $conexion = $conn->conectar();
    $query = $conexion->prepare("SELECT IdUsuario, Dni, Apellidos, Nombres FROM Usuario WHERE Dni=:dni AND Password=:pass");
    $query->bindParam(':dni', $dni);
    $query->bindParam(':pass', $password);
    $query->execute();
    $result = $query->fetch();
    return $result;
}

function LoginResponsable($dni,$password){
    $conn = new Conn();
    $conexion = $conn->conectar();
    $query = $conexion->prepare("SELECT IdResponsable, Dni, Apellidos, Nombres FROM Responsable WHERE Dni=:dni AND Password=:pass");
    $query->bindParam(':dni', $dni);
    $query->bindParam(':pass', $password);
    $query->execute();
    $result = $query->fetch();
    return $result;
}
?>