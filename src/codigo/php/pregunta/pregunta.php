<?php
  if (isset($_GET["idP"])) {
    $id = $_GET["idP"];
    require "../codigo/php/bbdd.php";
    $hilo = cargarHilo($id);
    $pregunta = cargarPregunta($hilo);
  } else {
    echo "<h1>404</h1>";
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>

<?php
function cargarPregunta($hilo) {
  
}
?>
