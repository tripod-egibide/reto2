<?php if (isset($_GET["id"])) { ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title></title>
  </head>

  <body>
    <?php

      session_start();
      include '../codigo/php/bbdd.php';
      include '../codigo/php/estilos.php';
      include "../partefija/header.php";
      $duenno = $_SESSION["id"] == $_GET["id"];
      $usuario = cargarUsuario(isset($_GET["id"]));

      if (isset($_FILES["avatar"])) {
        $uploadfile = "/imagenes/avatar/" . basename($_FILES['avatar']['name']);
        move_uploaded_file($_FILES['avatar']['tmp_name'], "..".$uploadfile);
        //la siguiente linea elimina el avatar anterior, que es importante en la vida real pero solo causa conflictos en desarrollo
        // unlink("../".$usuario["url_avatar"]);
        actualizarAvatar(["id" => $_GET["id"], "url" => $uploadfile]);
        header('Location: '.$_SERVER['REQUEST_URI']);
      }
      ?>
    <div class="gridContenedor">
      <main>
        <h1>
          <?=$usuario["usuario"]?>
        </h1>
        <div class="info">
          <div class="avatarYEstadisticas">
            <div class="divAvatar">
              <img src="<?=$usuario["url_avatar"]?>" alt="" id="granAvatar">
              <?php if ($duenno) { ?>
                <form class="subirAvatar" action="perfil.php?id=<?=$_GET["id"]?>" method="post" enctype="multipart/form-data">
                  <input type="file" name="avatar" accept="image/*"><br>
                  <input type="submit" value="Cambiar avatar">
                </form>
              <?php } ?>
            </div>
            <div class="estadisticasDeUsuario">
              <div class="preguntas">
                <?=$usuario["preguntas"]?> preguntas:<br>
                <i class="material-icons thumb" id="thumbUp">thumb_up</i> <?=$usuario["p_positivos"]?>
                <i class="material-icons thumb" id="thumbUp">thumb_down</i> <?=$usuario["p_negativos"]?>
              </div>
              <div class="respuestas">
                <?=$usuario["respuestas"]?> respuestas:<br>
                <i class="material-icons thumb" id="thumbUp">thumb_up</i> <?=$usuario["r_positivos"]?>
                <i class="material-icons thumb" id="thumbUp">thumb_down</i> <?=$usuario["r_negativos"]?>
              </div>
            </div>
          </div>
          <div class="modificables">
          <?php if ($duenno) {
            ?>
            <form action="" method="post">
              <label for="nickname">Nickname:</label><br>
              <input type="text" name="nickname" id="nickname"><br>
              <label for="email">Email:</label><br>
              <input type="email" name="email" id="email"><br>
              <label for="descripcion">Descripci&oacute;n:</label><br>
              <textarea name="descripcion" rows="8" cols="80" id="descripcion"></textarea>
              <input type="submit" name="" value="Actualizar">
            </form>
            <?php
              } else {
              ?>
            <label>Email:</label> <a href="mailto:<?=$usuario["email"]?>"><?=$usuario["email"]?></a><br>
            <p><?=$usuario["descripcion"]?></p>
            <?php } ?>
          </div>
        </div>
        <div class="listaPreguntas">
          <span>Ultimas preguntas: </span><br>
          <?php
          $preguntas = preguntasDeUsuario($_GET["id"]);
          foreach ($preguntas as $pregunta) {
            ?>
            <a href="/pregunta/pregunta.php?id=<?=$pregunta["idpregunta"]?>"><?=$pregunta["titulo"]?></a><br>
            <?php
          }
          ?>
        </div>
      </main>
    </div>
    <?php include "../partefija/footer.php" ?>
  </body>

</html>
<?php
} else {
  header('Location: /partefija/errores.php?error=404');
} ?>
