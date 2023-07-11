<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/controladores/VerificarLogin.php"); ?>
<?php $isLoggedIn = (isset($_SESSION["id"]) && $_SESSION["id"] != NULL) ? true : false; ?>
<nav class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-light" href="#">SISTEMA TURÍSTICO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php if($_SESSION["responsable"]==1): ?>
        <li class="nav-item">
          <a class="nav-link text-light" aria-current="page" href="../vistas/capacitacionesview.php">Capacitaciones</a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link text-light" aria-current="page" href="../vistas/destinosview.php">Destinos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="../vistas/establecimientoview.php">Establecimientos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="../vistas/responsableview.php">Responsables</a>
        </li>
      <?php endif; ?>
      </ul>
      <div class="d-flex" role="search">
        <a class="navbar-brand text-light fw-bold"><?php echo $_SESSION["usuario"] ?></a>
        <?php if($_SESSION["responsable"]==1): ?>
        <a class="navbar-brand me-4 text-light" href="../vistas/correoview.php"><i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i></a>
        <?php endif; ?>
      </div>
      <div class="d-flex">  
        <a class="navbar-brand text-light" href="../controladores/CerrarSesion.php"> <i class="fa fa-sign-out" aria-hidden="true"></i></a>
      </form>
    </div>
  </div>
</nav>