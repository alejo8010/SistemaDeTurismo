<?php
   include("controladores/ValidarLogin.php");
   $error = false;
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    $resultado = NULL;
    $esResponsable = false;
    if(isset($_POST['checkopcion'])){
        $resultado = LoginResponsable($_POST['dni'],$_POST['password']);
        $esResponsable=true;
    }else{
        $resultado = LoginUsuario($_POST['dni'],$_POST['password']);
    }

    if($resultado!=NULL) {
        session_start();
        $_SESSION['id'] = $esResponsable?$resultado["IdResponsable"]:$resultado['IdUsuario'];
        $_SESSION['usuario'] = $resultado["Apellidos"]." ".$resultado["Nombres"];
        $_SESSION['dni'] = $resultado["Dni"];
        $_SESSION['responsable'] = $esResponsable;
        var_dump($_SESSION);
        
        if($esResponsable){
            header("location: ./vistas/capatacionesview.php");
        }else{
            header("location: ./vistas/destinosview.php");
        }
     }else {
        $error = true;
     }

   }
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SISTEMA TURÍSTICO</title>
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/helpers/linker.php"); ?>
    <style>
        body:before {
            content: "";
            width: 100%;
            height: 100%;
            display: block;
            background: url("../img/fondo.png") no-repeat;
            background-position: center;
            background-size: cover;
            position: absolute;
        }
    </style>
  </head>

  <body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="border border-3 border-primary"></div>
                    <div class="card bg-white shadow-lg">
                        <div class="card-body p-5">
                            <form class="mb-3 mt-md-4" action="<?=$_SERVER["PHP_SELF"] ?>" method="post">
                            <h2 class="fw-bold mb-2 text-uppercase text-primary text-center">Sistema Turístico</h2>
                            <p class=" mb-4  text-center">Ingrese sus datos</p>
                            <?php if($error): ?>
                                <div class="alert alert-danger" role="alert">
                                    El usuario o contraseña ingresado es inválido.
                                </div>
                            <?php endif; ?>        
                            <div class="mb-3">
                                <label for="dni" class="form-label fw-bold text-primary">DNI:</label>
                                <input type="dni" class="form-control" id="dni" name="dni" placeholder="Ingrese su DNI">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold text-primary">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="*******">
                            </div>
                            <div class="mb-3">
                                <input class="form-check-input" type="checkbox" value="checkopcion" id="checkopcion" name="checkopcion">
                                <label for="checkopcion" class="form-label">Soy Responsable</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-outline-primary" type="submit">INGRESAR <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </body>

</html>