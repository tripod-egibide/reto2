<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    include '../php/bbdd.php';
    $usuario = cargarUsuario($_SESSION["id"]);
    var_dump($usuario);
    include "../partefija/header.php" ?>
    <div class="gridContenedor">
      <main>
        <img src="" alt="" id="granAvatar" ?>>
      </main>
    </div>
    <?php include "../partefija/footer.php" ?>
  </body>
</html>
