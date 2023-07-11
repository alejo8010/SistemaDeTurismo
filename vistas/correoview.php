
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correos Recibidos</title>
    <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/helpers/linker.php"); ?>
</head>
<body>
    <div class="container-fluid">
        <?php 
        include_once($_SERVER["DOCUMENT_ROOT"] . "/helpers/cabecera.php");
        include_once($_SERVER["DOCUMENT_ROOT"] . "/controladores/CorreoController.php");
        include_once($_SERVER["DOCUMENT_ROOT"] . "/controladores/CorreoController.php");
        $correocontroller = new CorreoController();
        $responsablecontroller = new ResponsableController();
        if($_SERVER["REQUEST_METHOD"] == "POST") {            
            $correocontroller -> enviarCorreo($_SESSION["id"],$_POST['idresponsable'],$_POST['asunto'],$_POST['mensaje']);
            echo $_SESSION["id"],$_POST['idresponsable'],$_POST['asunto'],$_POST['mensaje'];
            $_POST = array();
            header("location: correoview.php");
        }
        ?>
        <div class="row mt-3">
            <div class="col-9 text-start">
                <h3>Correos Recibidos</h3>
            </div>
            <div class="col-3 text-end">
                <button class="btn btn-warning fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ESCRIBIR CORREO</button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Remitente</th>
                        <th class="text-center">Asunto</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $correos = $correocontroller -> mostrarRecibidos($_SESSION["id"]);
                    foreach ($correos as $correo) {
                    echo "<tr><td class='text-center'>".$correo["IdCorreo"]."</td><td class='text-center'>".$correo["ApellidosRemitente"]." ".$correo["NombresRemitente"]."</td><td class='text-center'>".$correo["Asunto"]."</td>
                    <td class='text-center'>".$correo["Fecha"]."</td><td class='text-center'><button data-bs-toggle='modal' data-bs-target='#infoMensaje' class='btn btn-success btn-sm' onclick='ver(\"".$correo["ApellidosRemitente"]." ".$correo["NombresRemitente"]."\",\"".$correo["Asunto"]."\",\"".$correo["Cuerpo"]."\",\"".$correo["Fecha"]."\")'><i class='fa fa-eye fa-lg' aria-hidden='true'></i> </button></td></tr>";
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Correo</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formNuevo" action="<?=$_SERVER["PHP_SELF"] ?>" method="post">
                <div class="mb-3">
                    <label for="idresponsable" class="form-label">Destinatario:</label>
                    <select name="idresponsable" id="idresponsable" required class="form-select" aria-label="idresponsable">
                        <option value="">SELECCIONE DESTINATARIO</option>
                        <?php
                        $responsables = $responsablecontroller -> mostrarDiferente($_SESSION["id"]);
                        foreach ($responsables as $responsable) {
                            echo "<option value='".$responsable['IdResponsable']."' class='fw-bold'>".$responsable['Apellidos']." ".$responsable['Nombres']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="asunto" class="form-label">Asunto:</label>
                    <input required type="text" class="form-control" id="asunto" name="asunto" placeholder="Ingrese Asunto">
                </div>
                <div class="mb-3">
                    <label for="mensaje" class="form-label">Mensaje:</label>
                    <textarea required class="form-control" id="mensaje" name="mensaje" rows="3" placeholder="Ingrese Mensaje"></textarea>
                </div> 
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" form="formNuevo" class="btn btn-success">Enviar <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
        </div>
        </div>
    </div>
    </div>


        <!-- Modal Ver -->
    <div class="modal fade" id="infoMensaje" tabindex="-1" aria-labelledby="infoMensaje" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="infoMensaje">Información del Correo Recibido</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="formNuevo" action="<?=$_SERVER["PHP_SELF"] ?>" method="post">
                <div class="mb-3">
                    <label for="fechare" class="form-label">Fecha Recepción:</label>
                    <input type="date" class="form-control" id="fechare" name="fechare" readonly> 
                </div>
                <div class="mb-3">
                    <label for="remitente" class="form-label">Remitente:</label>
                    <input type="text" class="form-control" id="remitente" name="remitente" readonly>
                </div>
                <div class="mb-3">
                    <label for="asuntore" class="form-label">Asunto:</label>
                    <input type="text" class="form-control" id="asuntore" name="asuntore" readonly>
                </div>
                <div class="mb-3">
                    <label for="mensajere" class="form-label">Mensaje:</label>
                    <textarea class="form-control" id="mensajere" name="mensajere" rows="3" readonly></textarea>
                </div> 
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
    </div>
     <script>
        function ver(remitente, asunto, cuerpo, fecha){
            document.getElementById('fechare').value = fecha;
            document.getElementById('remitente').value = remitente;
            document.getElementById('asuntore').value = asunto;
            document.getElementById('mensajere').value = cuerpo;
        }
     </script>                   
</body>
</html>
