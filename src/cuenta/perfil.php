<?php
require "../codigo/php/bbdd.php";
if (isset($_GET["id"])) {
  session_start();
  $duenno = false;
  if (isset($_SESSION["id"])) {
    $duenno = $_SESSION["id"] == $_GET["id"];
  }
  $usuario = cargarUsuario($_GET["id"]);

  if (isset($_POST["descripcion"])) {
    actualizarDescripcion(["id" => $_GET["id"], "descripcion" => $_POST["descripcion"]]);
    header('Location: '.$_SERVER['REQUEST_URI']);
  }

  if (isset($_FILES["avatar"])) {
    $uploadfile = "/imagenes/avatar/" . basename($_FILES['avatar']['name']);
    move_uploaded_file($_FILES['avatar']['tmp_name'], "..".$uploadfile);
    //la siguiente linea elimina el avatar anterior, que es importante en la vida real pero solo causa conflictos en desarrollo
    // unlink("../".$usuario["url_avatar"]);
    actualizarAvatar(["id" => $_GET["id"], "url" => $uploadfile]);
    header('Location: '.$_SERVER['REQUEST_URI']);
  }?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title><?=$usuario["usuario"]?></title>
    <?php include '../codigo/php/estilos.php';?>
    <link rel="stylesheet" href="/codigo/css/perfil.css">
  </head>

  <body>
    <div class="gridContenedor">
      <?php include "../partefija/header.php"; ?>
      <main class="main">
        <h1 class="usuario">
          <?=$usuario["usuario"]?>
        </h1>
        <div class="info">
          <div class="avatarYEstadisticas">
            <div class="divAvatar">
              <img src="<?=$usuario["url_avatar"]?>" alt="" id="granAvatar">
              <?php if ($duenno) { ?>
                <form class="subirAvatar" action="perfil.php?id=<?=$_GET["id"]?>" method="post" enctype="multipart/form-data">
					<!-- Añadir el onchange en el script -->
                  <input type="file" name="avatar" accept="image/*" onchange="submit()"><br>
                  <!-- <input type="submit" value="Cambiar avatar"> -->
                </form>
              <?php } ?>
            </div>
            <div class="estadisticasDeUsuario">
              <div class="preguntas">
                <span><?=$usuario["preguntas"]?> preguntas:</span>
                <div>
                  <i class="material-icons thumb" id="thumbUp">thumb_up</i> <?=$usuario["p_positivos"]?>
                  <i class="material-icons thumb" id="thumbUp">thumb_down</i> <?=$usuario["p_negativos"]?>
                </div>                
              </div>
              <div class="respuestas">
                 <span><?=$usuario["respuestas"]?> respuestas:</span>
                 <div>
                   <i class="material-icons thumb" id="thumbUp">thumb_up</i> <?=$usuario["r_positivos"]?>
                   <i class="material-icons thumb" id="thumbUp">thumb_down</i> <?=$usuario["r_negativos"]?>
                 </div>
              </div>
            </div>
          </div>
          <div class="datos">
			  <div class="email">
				  <label><i class="material-icons">email</i></label>
				  <a href="mailto:<?=$usuario["email"]?>"><?=$usuario["email"]?></a><br>
			  </div>
          <?php if ($duenno) {
            ?>
			<div class="desc">
				<form action="perfil.php?id=<?=$_GET["id"]?>" method="post">
				  <label for="descripcion">Descripci&oacute;n:</label><br>
				  <textarea name="descripcion" rows="16" cols="40" id="descripcion" maxlength=1000 placeholder="Nueva desripci&oacute;n..."><?=$usuario["descripcion"]?></textarea>
				  <input type="submit" name="" value="Actualizar">
				</form>
			</div>
            <?php
              } else {
              ?>
            <p class="desc"><?=$usuario["descripcion"]?></p>
            <?php } ?>
          </div>
        </div>
        <div class="listaPreguntas">
          <span>Ultimas preguntas: </span><br>
		  <div class="fondoCCC">
          <?php
          $preguntas = preguntasDeUsuario($_GET["id"]);
          foreach ($preguntas as $pregunta) {
            ?>
            <a href="/pregunta/pregunta.php?id=<?=$pregunta["idpregunta"]?>"><?=$pregunta["titulo"]?></a><br>
            <?php
          }
          ?>
		  </div>
        </div>
      </main>
      <div class="margen">
        <?php include "../partefija/margen.php" ?>
      </div>
      <?php include "../partefija/footer.php" ?>
    </div>
  </body>

</html>
<?php
} else {
  header('Location: /partefija/errores.php?error=404');
} ?>
