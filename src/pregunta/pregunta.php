<!-- por ahora todo esto ha sido programado a ciegas, hay que comprobar TOOODOOOO -->
<?php
  include("../partefija/header.php");
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
    <link rel="stylesheet" href="../codigo/css/pregunta.css">
  </head>

  <body>
    <div class="post" id="pregunta">
      <div class="cabeceraPost" id="cabeceraPregunta">
        <h1 class="titulo" id="tituloPregunta">
          <?=$pregunta["titulo"]?>
        </h1>
        <!-- TODO: dar formato a la fecha o hacer un "escrito hace 3 dias y una hora" -->
        <span class="fecha"><?=$pregunta["fecha_creacion"]?></span>
        <!-- TODO: enlazar esto al perfil del usuario correspondiente -->
        <span class="autor"><a href="../cuenta/perfil.php?id=<?=$pregunta["idusuario"]?>">
          <?=$pregunta["usuario"]?> <img src="<?=$pregunta["url_avatar"]?>">
        </a></span>
      </div>
      <div class="votos">
        <i class="material-icons">arrow_drop_up</i>
        <span class="votosContador"><?php echo $pregunta["positivos"]-$pregunta["negativos"]; ?></span>
        <i class="material-icons">arrow_drop_down</i>
      </div>
      <p class="cuerpo"><?=$pregunta["texto"]?></p>
      <div id="piePregunta">
        <span id="contadorRespuestas">
        <?php
          $contadoRespuestas = $respuestas->rowCount();
          echo ($contadoRespuestas == 1) ? "1 respuesta." : $contadoRespuestas . " respuestas.";
        ?>
        <span>
        <ul id="etiquetas">
          <?php
          foreach ($etiquetas as $etiqueta) {
            // TODO: enlazar las etiquetas a una busqueda de preguntas con la misma etiqueta
            $str = $etiqueta["etiqueta"];
            echo "<li>$str</li>";
          }
          ?>
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
        </h2>
        <span class="fecha"><?=$respuesta["fecha_creacion"]?></span>
        <span class="creador"><a href="../cuenta/perfil.php?id=<?=$respuesta["idusuario"]?>"><?=$respuesta["usuario"]?></a></span>
        <img src="../imagenes/avatares/<?=$respuesta["idusuario"]?>.jpg">
      </div>
      <div class="votos">
        <i class="material-icons">arrow_drop_up</i>
        <span class="votosContador"><?php echo $respuesta["positivos"]-$respuesta["negativos"] ?></span>
        <i class="material-icons">arrow_drop_down</i>
      </div>
      <p class="cuerpo"><?=$pregunta["texto"]?></p>
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
