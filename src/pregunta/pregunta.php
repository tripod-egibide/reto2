<!-- por ahora todo esto ha sido programado a ciegas, hay que comprobar TOOODOOOO -->
<?php
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    require "../codigo/php/bbdd.php";
    $datos = cargarPregunta($id);
    $pregunta = $datos["pregunta"]->fetch(0);
    $respuestas = $datos["respuestas"];
    $etiquetas = $datos["etiquetas"];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>
      <?=$pregunta["titulo"]?>
    </title>
    <link rel="stylesheet" href="../iconos/iconos.css">
  </head>

  <body>
    <div class="post" id="pregunta">
      <div class="cabeceraPost" id="cabeceraPregunta">
        <h1 class="titulo" id="tituloPregunta">
          <?=$pregunta["titulo"]?>
        </h1>
        <span class="informacion" id="informacionPregunta"></span>
        <span class="fecha"><?=$pregunta["fecha_creacion"]?></span>
      </div>
      <div class="votos">
        <i class="material-icons">arrow_drop_up</i>
        <span class="votosContador"><?php echo $pregunta["positivos"]-$pregunta["negativos"] ?></span>
        <i class="material-icons">arrow_drop_down</i>
      </div>
      <p class="cuerpo">
        <?=$pregunta["texto"]?>
      </p>
      <div id="piePregunta">
        <span id="contadorRespuestas"></span>
        <ul id="etiquetas">
          <?php
          while ($etiqueta = $etiquetas->fetch()) {
            $str = $etiqueta["etiqueta"];
            echo "<li>$str</li>";
          }
          ?>
          <?php // TODO: dar formato a la fecha para que sea lindo ?>
        </ul>
      </div>
    </div>
<hr>
    <?php
    while ($respuesta = $respuestas->fetch()) {
      ?>
    <div class="post respuesta">
      <div class="cabeceraPost">
        <h2 class="titulo">
          <?=$respuesta["titulo"]?>
          </h1>
          <span class="informacion"></span>
      </div>
      <div class="votos">
        <i class="material-icons">arrow_drop_up</i>
        <span class="votosContador"><?php echo $respuesta["positivos"]-$respuesta["negativos"] ?></span>
        <i class="material-icons">arrow_drop_down</i>      </div>
      <p class="cuerpo">Cuerpo</p>
    </div>
    <?php
    }
    ?>



  </body>

</html>
<?php
  } else {
    echo "<h1>404</h1>";
  }
?>
