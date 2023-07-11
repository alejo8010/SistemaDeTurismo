<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Establecimientos</title>
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
        include_once($_SERVER["DOCUMENT_ROOT"] . "/controladores/EstablecimientoController.php");
        include_once($_SERVER["DOCUMENT_ROOT"] . "/controladores/DestinoController.php");
        include_once($_SERVER["DOCUMENT_ROOT"] . "/controladores/ResponsableController.php");
        $establecimientocontroller = new EstablecimientoController();
        $destinocontroller = new DestinoController();
        $responsablecontroller = new ResponsableController();
        if($_SERVER["REQUEST_METHOD"] == "POST") {       
            
            if($_POST['idestablecimientoval']>0){
                $establecimientocontroller -> asignar($_POST['idestablecimientoval'],$_POST['idresponsable']);
                $_POST = array();
                header("location: establecimientoview.php");
            }elseif($_POST['idresponsableup']>0){
                $establecimientocontroller -> asignar($_POST['idestablecimientoup'],$_POST['idresponsableup']);
                $_POST = array();
                header("location: establecimientoview.php");
            }elseif($_POST['idup']>0){
                $establecimientocontroller -> editar($_POST['idup'],strtoupper($_POST['nombreestaup']),strtoupper($_POST['direccionup']),$_POST['iddestinoup']);
                $_POST = array();
                header("location: establecimientoview.php");
            }else{
                $establecimientocontroller -> guardar(strtoupper($_POST['nombre']),strtoupper($_POST['direccion']),$_POST['iddestino'],$_SESSION['id']);
                $_POST = array();
                header("location: establecimientoview.php");
            }


        }
        ?>
        <div class="row mt-3">
            <div class="col-9 text-start">
                <h3>Establecimientos Registrados</h3>
            </div>
            <div class="col-3 text-center">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#establecimientoModal">NUEVO ESTABLECIMIENTO</button>
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
                        <th class="text-center">Dirección</th>
                        <th class="text-center">Destino Turístico</th>
                        <th class="text-center">Creado Por</th>
                        <th class="text-center">Responsable</th>
                        <th class="text-center">Fecha de Asignación</th>
                        <th class="text-center">Accion Responsable</th>
                        <th class="text-center">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $establecimientos = $establecimientocontroller -> mostrar();
                    foreach ($establecimientos as $establecimiento) {
                    echo "<tr><td class='text-center'>".$establecimiento["IdEstablecimiento"]."</td><td class='text-center'>".$establecimiento["NombreEstablecimiento"]."</td><td class='text-center'>".$establecimiento["Direccion"]."</td>
                    <td class='text-center'>".$establecimiento["NombreDestino"]."</td><td class='text-center'>".$establecimiento["ApellidosUsuario"]." ".$establecimiento["NombresUsuario"]."</td><td class='text-center'>".($establecimiento["IdResponsable"]?$establecimiento["ApellidosResponsable"]." ".$establecimiento["NombresResponsable"]:"<span class='badge text-bg-danger'>NO ASIGNADO</span>")."</td>
                    <td class='text-center'>".($establecimiento["IdResponsable"]?$establecimiento["FechaAsignacion"]:"<span class='badge text-bg-danger'>SIN FECHA</span>")."</td><td class='text-center'>".($establecimiento["IdResponsable"]?"<button class='btn btn-warning btn-sm' onclick='actualizar(".$establecimiento["IdEstablecimiento"].",\"".$establecimiento["NombreEstablecimiento"]."\",\"".$establecimiento["ApellidosResponsable"]." ".$establecimiento["NombresResponsable"]."\")' data-bs-toggle='modal' data-bs-target='#actualizarModal'>Cambiar</button>":"<button class='btn btn-primary btn-sm' onclick='asignar(".$establecimiento["IdEstablecimiento"].",\"".$establecimiento["NombreEstablecimiento"]."\")' data-bs-toggle='modal' data-bs-target='#asignarModal'>Asignar</button>")."</td>
                    <td class='text-center'><button onclick='editar(".$establecimiento["IdEstablecimiento"].",\"".$establecimiento["NombreEstablecimiento"]."\",\"".$establecimiento["Direccion"]."\",\"".$establecimiento["NombreDestino"]."\")' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editarModal'>Editar</button></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="establecimientoModal" tabindex="-1" aria-labelledby="establecimientoModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="establecimientoModal">Nuevo Establecimiento</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formNuevo" action="<?=$_SERVER["PHP_SELF"] ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input  required type="text" class="form-control text-uppercase" id="nombre" name="nombre" placeholder="Ingrese nombre">
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <textarea required class="form-control text-uppercase" id="direccion" name="direccion" rows="3" placeholder="Ingrese dirección"></textarea>
                </div>
                <div class="mb-3">
                    <label for="iddestino" class="form-label">Destino Turístico:</label>
                    <select name="iddestino" id="iddestino" required class="form-select" aria-label="iddestino">
                        <option value="">SELECCIONE DESTINO TURÍSTICO</option>
                        <?php
                        $destinos = $destinocontroller -> mostrar();
                        foreach ($destinos as $destino) {
                            echo "<option value='".$destino['IdDestinoTuristico']."' class='fw-bold'>".$destino['NombreDestino']." - ".$destino['Departamento']."</option>";
                        }
                        ?>
                    </select>
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


    <!-- Modal Asignar -->
    <div class="modal fade" id="asignarModal" tabindex="-1" aria-labelledby="asignarModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="asignarModal">Asignar Responsable</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formAsignar" action="<?=$_SERVER["PHP_SELF"] ?>" method="post">
                <input  required type="hidden" class="form-control text-uppercase" id="idestablecimientoval" name="idestablecimientoval">
                <div class="mb-3">
                    <label for="nombreval" class="form-label">Establecimiento:</label>
                    <input required disabled type="text" class="form-control text-uppercase" id="nombreval" name="nombreval" placeholder="Ingrese nombre">
                </div>
                <div class="mb-3">
                    <label for="idresponsable" class="form-label">Responsable:</label>
                    <select name="idresponsable" id="idresponsable" required class="form-select" aria-label="idresponsable">
                        <option value="">SELECCIONE RESPONSABLE</option>
                        <?php
                        $responsables = $responsablecontroller -> mostrar();
                        foreach ($responsables as $responsable) {
                            echo "<option value='".$responsable['IdResponsable']."' class='fw-bold'>".$responsable['Apellidos']." ".$responsable['Nombres']."</option>";
                        }
                        ?>
                    </select>
                </div>             
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" form="formAsignar" class="btn btn-success">Asignar</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal Actualizar -->
    <div class="modal fade" id="actualizarModal" tabindex="-1" aria-labelledby="actualizarModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="actualizarModal">Cambiar Responsable</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formActualizar" action="<?=$_SERVER["PHP_SELF"] ?>" method="post">
                <input  required type="hidden" class="form-control text-uppercase" id="idestablecimientoup" name="idestablecimientoup">
                <div class="mb-3">
                    <label for="nombreup" class="form-label">Establecimiento:</label>
                    <input required disabled type="text" class="form-control text-uppercase" id="nombreup" name="nombreup" placeholder="Ingrese nombre">
                </div>
                <div class="mb-3">
                    <label for="responsableup" class="form-label">Responsable Anterior:</label>
                    <input required disabled type="text" class="form-control text-uppercase" id="responsableup" name="responsableup" placeholder="Ingrese nombre">
                </div>
                <div class="mb-3">
                    <label for="idresponsableup" class="form-label">Responsable Nuevo:</label>
                    <select name="idresponsableup" id="idresponsableup" required class="form-select" aria-label="idresponsableup">
                        <option value="">SELECCIONE RESPONSABLE</option>
                        <?php
                        $responsables = $responsablecontroller -> mostrar();
                        foreach ($responsables as $responsable) {
                            echo "<option value='".$responsable['IdResponsable']."' class='fw-bold'>".$responsable['Apellidos']." ".$responsable['Nombres']."</option>";
                        }
                        ?>
                    </select>
                </div>             
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" form="formActualizar" class="btn btn-success">Cambiar</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="editarModal">Editar Establecimiento</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formEditar" action="<?=$_SERVER["PHP_SELF"] ?>" method="post">
                <div class="mb-3">
                    <label for="idup" class="form-label">ID:</label>
                    <input  required type="text" class="form-control text-uppercase" id="idup" name="idup" placeholder="Ingrese nombre" readonly>
                </div>
                <div class="mb-3">
                    <label for="nombreestaup" class="form-label">Nombre:</label>
                    <input  required type="text" class="form-control text-uppercase" id="nombreestaup" name="nombreestaup" placeholder="Ingrese nombre">
                </div>
                <div class="mb-3">
                    <label for="direccionup" class="form-label">Dirección:</label>
                    <textarea required class="form-control text-uppercase" id="direccionup" name="direccionup" rows="3" placeholder="Ingrese dirección"></textarea>
                </div>
                <div class="mb-3">
                    <label for="destinonombreup" class="form-label">Destino Turístico Anterior:</label>
                    <input  required type="text" class="form-control text-uppercase" id="destinonombreup" name="destinonombreup" disabled>
                </div>
                <div class="mb-3">
                    <label for="iddestinoup" class="form-label">Destino Turístico Nuevo:</label>
                    <select name="iddestinoup" id="iddestinoup" class="form-select" aria-label="iddestinoup">
                        <option value="0">NO ACTUALIZAR</option>
                        <?php
                        $destinos = $destinocontroller -> mostrar();
                        foreach ($destinos as $destino) {
                            echo "<option value='".$destino['IdDestinoTuristico']."' class='fw-bold'>".$destino['NombreDestino']." - ".$destino['Departamento']."</option>";
                        }
                        ?>
                    </select>
                </div>             
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" form="formEditar" class="btn btn-success">Actualizar</button>
        </div>
        </div>
    </div>
    </div>
    
    <script>
        function asignar(id, nombre){
            document.getElementById('idestablecimientoval').value = id;
            document.getElementById('nombreval').value = nombre;
        }

        function actualizar(id, nombre, responsable){
            document.getElementById('idestablecimientoup').value = id;
            document.getElementById('nombreup').value = nombre;
            document.getElementById('responsableup').value = responsable;
        }

        function editar(id, nombre, direccion, destino){
            document.getElementById('idup').value = id;
            document.getElementById('nombreestaup').value = nombre;
            document.getElementById('direccionup').value = direccion;
            document.getElementById('destinonombreup').value = destino;
        }
    </script>
</body>
</html>