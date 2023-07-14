<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destino Turístico</title>
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
        include_once($_SERVER["DOCUMENT_ROOT"] . "/controladores/destinocontroller.php");
        $destinocontrolador = new destinocontroller();
        if($_SERVER["REQUEST_METHOD"] == "POST") {            
            $destinocontrolador -> guardar(strtoupper($_POST['nombre']),strtoupper($_POST['departamento']),strtoupper($_POST['provincia']),strtoupper($_POST['distrito']));
            $_POST = array();
            header("location: destinosview.php");
        }
        ?>
        <div class="row mt-3">
            <div class="col-9 text-start">
                <h3>Destinos Turísticos Registrados</h3>
            </div>
            <div class="col-3 text-center">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">NUEVO DESTINO</button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Departamento</th>
                        <th class="text-center">Provincia</th>
                        <th class="text-center">Distrito</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $destinos = $destinocontrolador -> mostrar();
                    foreach ($destinos as $destino) {
                    echo "<tr><td class='text-center'>".$destino["IdDestinoTuristico"]."</td><td class='text-center'>".$destino["NombreDestino"]."</td><td class='text-center'>".$destino["Departamento"]."</td>
                    <td class='text-center'>".$destino["Provincia"]."</td><td class='text-center'>".$destino["Distrito"]."</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Destino Turístico</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formNuevo" action="<?=$_SERVER["PHP_SELF"] ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input  required type="text" class="form-control text-uppercase" id="nombre" name="nombre" placeholder="Ingrese nombre">
                </div>
                <div class="mb-3">
                    <label for="departamento" class="form-label">Departamento:</label>
                        <select required class="form-select" aria-label="departamento" name="departamento" id="departamento">
                        <option value=''>SELECCIONE</option>
                        <option value='AMAZONAS'>AMAZONAS</option>
                        <option value='ÁNCASH'>ÁNCASH</option>
                        <option value='APURIMAC'>APURIMAC</option>
                        <option value='AREQUIPA'>AREQUIPA</option>
                        <option value='AYACUCHO'>AYACUCHO</option>
                        <option value='CAJAMARCA'>CAJAMARCA</option>
                        <option value='CALLAO'>CALLAO</option>
                        <option value='CUSCO'>CUSCO</option>
                        <option value='HUANCAVELICA'>HUANCAVELICA</option>
                        <option value='HUANUCO'>HUANUCO</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="provincia" class="form-label">Provincia:</label>
                    <input  required type="text" class="form-control text-uppercase" id="provincia" name="provincia" placeholder="Ingrese provincia">
                </div>
                <div class="mb-3">
                    <label for="distrito" class="form-label">Distrito:</label>
                    <input  required type="text" class="form-control text-uppercase" id="distrito" name="distrito" placeholder="Ingrese distrito">
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

</body>
</html>