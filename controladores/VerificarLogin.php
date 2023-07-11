<?php
session_start();

$now = time();
if (isset($_SESSION['expire']) && $now > $_SESSION['expire']) {
  session_destroy();
  header('Location: ' . 'http://' . $_SERVER['HTTP_HOST']);
  exit();
}
if (!isset($_SESSION['id'])) {
  //header("location: /");
  ?>
  <script>
    window.location.href = "/"
  </script>
  <?php
    //header('Location: ' . 'http://' . $_SERVER['HTTP_HOST']);
    exit();
    
}
?>