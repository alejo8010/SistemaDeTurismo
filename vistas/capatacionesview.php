<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capacitaciones</title>
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/helpers/linker.php"); ?>
</head>
<body>
    <div class="container-fluid">
        <?php 
        include_once($_SERVER["DOCUMENT_ROOT"] . "/helpers/cabecera.php");
        include_once($_SERVER["DOCUMENT_ROOT"] . "/controladores/capacitacioncontroller.php");
        include_once($_SERVER["DOCUMENT_ROOT"] . "/controladores/establecimientocontroller.php");
        $capacitacioncontrolador = new capacitacioncontroller();
        $establecimientocontrolador = new establecimientocontroller();
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $capacitacioncontrolador -> guardar($_POST['idestablecimiento'],strtoupper($_POST['nombre']),strtoupper($_POST['fecha']));
            $_POST = array();
            header("location: ./capacitacionesview.php");
        }
        ?>
        <div class="row mt-3">
            <div class="col-9 text-start">
                <h3>Mis Capacitaciones Registradas</h3>
            </div>
            <div class="col-3 text-center">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevo">NUEVA CAPACITACION</button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre Capacitacion</th>
                        <th class="text-center">Establecimiento</th>
                        <th class="text-center">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $capacitaciones = $capacitacioncontrolador -> mostrar($_SESSION["id"]);
                    foreach ($capacitaciones as $capacitacion) {
                    echo "<tr><td class='text-center'>".$capacitacion["IdCapacitacion"]."</td><td class='text-center'>".$capacitacion["NombreCapacitacion"]."</td><td class='text-center'>".$capacitacion["NombreEstablecimiento"]."</td>
                    <td class='text-center'>".$capacitacion["Fecha"]."</td></tr>";
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
            <h1 class="modal-title fs-5" id="modalNuevo">Nueva Capacitación</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formNuevo" action="<?=$_SERVER["PHP_SELF"] ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input  required type="text" class="form-control text-uppercase" id="nombre" name="nombre" placeholder="Ingrese nombre">
                </div>
                <div class="mb-3">
                    <label for="idestablecimiento" class="form-label">Establecimiento:</label>
                    <select name="idestablecimiento" id="idestablecimiento" required class="form-select" aria-label="idestablecimiento">
                        <option value="">SELECCIONE ESTABLECIMIENTO ASIGNADO</option>
                        <?php
                        $establecimientos = $establecimientocontrolador -> mostrarResponsable($_SESSION["id"]);
                        foreach ($establecimientos as $establecimiento) {
                            echo "<option value='".$establecimiento['IdEstablecimiento']."' class='fw-bold'>".$establecimiento['NombreEstablecimiento']." - ".$establecimiento['NombreDestino']."</option>";
                        }
                        ?>
                    </select>
                </div>   

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input  required type="date" class="form-control text-uppercase" id="fecha" name="fecha" placeholder="Ingrese DNI">
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

    <script>

    </script>               
</body>
</html>