<h1>INICIAR SESION</h1>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <input type="text" name="Dni" placeholder="Ingrese DNI" required><br>
    <input type="password" name="Password" placeholder="Ingrese contraseña" required><br>
    <input type="submit" value="Ingresar"><br>
</form>
<?php

   //echo password_hash("123456", PASSWORD_DEFAULT);

    if(!empty($_POST)){
        $Dni = trim($_POST["Dni"]);
        $Password = trim($_POST["Password"]);
        $errores = 0;
        
         if($Dni==""){
            echo "ingrese dni<br>";
            $errores++;
         }
         if($Password==""){
            echo "ingrese contraseña<br>";
            $errores++;
         }
         if($errores==0){

        
        require_once "controladores/ValidarLogin.php";

        $uc = new ValidarLogin();
        $resultado = $uc->login($Dni, $Password);
        
        if($resultado!=0){
            header("location: mostrar.php");
        }else{
            echo "usuario y/o contraseña incorrectos";
        }
    }
    }
?>