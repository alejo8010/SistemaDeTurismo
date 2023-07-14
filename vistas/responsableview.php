<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsables</title>
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/helpers/linker.php"); ?>
</head>
<body>
    <div class="container-fluid">
        <?php 
        include_once($_SERVER["DOCUMENT_ROOT"] . "/helpers/cabecera.php");
        if (isset($_SESSION['responsable']) && $_SESSION['responsable']==1) {
            echo "<div class='alert alert-danger mt-2' role='alert'>No tiene acceso a este modulo</div>";
            exit();
        }
        include_once($_SERVER["DOCUMENT_ROOT"] . "/controladores/responsablecontroller.php");
        $responsablecontrolador = new responsablecontroller();
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if($_POST['idupdate'] > 0){
                $responsablecontrolador -> actualizar($_POST['idupdate'],$_POST['dniup'],strtoupper($_POST['apellidosup']),strtoupper($_POST['nombresup']),$_POST['passwordup']);
                $_POST = array();
                header("location: responsableview.php");
            }else{
                $responsablecontrolador -> guardar($_POST['dni'],strtoupper($_POST['apellidos']),strtoupper($_POST['nombres']),$_POST['password']);
                $_POST = array();
                header("location: responsableview.php");
            }
        }
        ?>
        <div class="row mt-3">
            <div class="col-9 text-start">
                <h3>Responsables Registrados</h3>
            </div>
            <div class="col-3 text-center">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevo">NUEVO RESPONSABLE</button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">DNI</th>
                        <th class="text-center">Apellidos</th>
                        <th class="text-center">Nombres</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $responsables = $responsablecontrolador -> mostrar();
                    foreach ($responsables as $responsable) {
                    echo "<tr><td class='text-center'>".$responsable["IdResponsable"]."</td><td class='text-center'>".$responsable["Dni"]."</td>
                    <td class='text-center'>".$responsable["Apellidos"]."</td><td class='text-center'>".$responsable["Nombres"]."</td>
                    <td class='text-center'><button onclick='actualizar(".$responsable["IdResponsable"].",\"".$responsable["Dni"]."\",\"".$responsable["Apellidos"]."\",\"".$responsable["Nombres"]."\",\"".$responsable["Password"]."\")' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editarModal'>Editar</button></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalNuevo" tabindex="-1" aria-labelledby="modalNuevo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalNuevo">Nuevo Responsable</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formNuevo" action="<?=$_SERVER["PHP_SELF"] ?>" method="post">
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI:</label>
                    <input  required type="text" class="form-control text-uppercase" id="dni" name="dni" placeholder="Ingrese DNI">
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input  required type="text" class="form-control text-uppercase" id="apellidos" name="apellidos" placeholder="Ingrese apellidos">
                </div>
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres:</label>
                    <input  required type="text" class="form-control text-uppercase" id="nombres" name="nombres" placeholder="Ingrese nombres">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input  required type="password" class="form-control text-uppercase" id="password" name="password" placeholder="Ingrese contraseña">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" form="formNuevo" class="btn btn-success">Guardar</button>
        </div>
        </div>
    </div>
    </div>

       <!-- Modal Update-->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="editarModal">Editar Responsable</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formActualizar" action="<?=$_SERVER["PHP_SELF"] ?>" method="post">
                <div class="mb-3">
                    <label for="idupdate" class="form-label">ID:</label>
                    <input required type="number" class="form-control text-uppercase" id="idupdate" name="idupdate" readonly>
                </div>
                <div class="mb-3">
                    <label for="dniup" class="form-label">DNI:</label>
                    <input  required type="text" class="form-control text-uppercase" id="dniup" name="dniup" placeholder="Ingrese DNI">
                </div>
                <div class="mb-3">
                    <label for="apellidosup" class="form-label">Apellidos:</label>
                    <input  required type="text" class="form-control text-uppercase" id="apellidosup" name="apellidosup" placeholder="Ingrese apellidos">
                </div>
                <div class="mb-3">
                    <label for="nombresup" class="form-label">Nombres:</label>
                    <input  required type="text" class="form-control text-uppercase" id="nombresup" name="nombresup" placeholder="Ingrese nombres">
                </div>
                <div class="mb-3">
                    <label for="passwordup" class="form-label">Contraseña:</label>
                    <input  required type="password" class="form-control text-uppercase" id="passwordup" name="passwordup" placeholder="Ingrese contraseña">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" form="formActualizar" class="btn btn-success">Guardar</button>
        </div>
        </div>
    </div>
    </div>
    <script>
        function actualizar(id, dni, apellidos, nombres, password){
            document.getElementById('idupdate').value = id;
            document.getElementById('dniup').value = dni;
            document.getElementById('apellidosup').value = apellidos;
            document.getElementById('nombresup').value = nombres;
            document.getElementById('passwordup').value = password;
        }
    </script>               
</body>
</html>