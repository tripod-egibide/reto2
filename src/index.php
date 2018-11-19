<?php // TODO: annadir un control de paginas, para que salte un 404 si la pagina estuviese vacia ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stack Underflow</title>
    <?php include "./codigo/php/globales.php" ?>
  </head>

  <body>
    <div class="gridContenedor">
      <?php include "./partefija/header.php" ?>
      <div class="margen"></div>
      <div class="main">
        <a href="http://localhost/pregunta/publicarPregunta.php">Publicar Pregunta</a>
        <?php
        $pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : 0;
        require "codigo/php/bbdd.php";
        $datos = cargarIndex($pagina);
        foreach ($datos as $pregunta) {
          ?>
          <div class="pregunta">
            <?php
            if ($pregunta["resuelto"]) {
              echo '<i class="material-icons">check</i>';
            }
            ?>
            <span class="respuestas"><?php echo ($pregunta["respuestas"] == 1) ? "1 respuesta." : $pregunta["respuestas"] . " respuestas." ?></span>
            <span class="votos"><?=$pregunta["votos"]?><i class="material-icons">thumb_up</i></span>
            <div class="info">
              <span class="titulo"><a href="pregunta/pregunta.php?id=<?=$pregunta["idpregunta"]?>"><?=$pregunta["titulo"]?></a></span>
              <span class="autor"><a href="../cuenta/perfil.php?id=<?=$pregunta["idusuario"]?>">
                <?=$pregunta["usuario"]?> <img src="<?=$pregunta["url_avatar"]?>">
              </a></span>
              <span class="fecha"><?=$pregunta["fecha_creacion"]?></span>
            </div>
            <ul class="etiquetas">
              <?php
              foreach ($pregunta["etiquetas"] as $etiquetas) {
               echo "<li>" . $etiquetas[0] . "</li>";
              }
              ?>
            </ul>
          </div>
          <?php
        }
        ?>

        <div class="navegacion">
          <?php
          //si estamos en la pagina 0, no mostramos el boton de retroceder pagina
          if ($pagina>0) {
             ?> <a href="?pagina=<?=$pagina-1?>"><button type="button">P&aacute;gina anterior</button></a> <?php
          }
          //buscamos la menor ID en la pagina para saber si hay mas preguntas que mostrar
          //es decir, si hay mas paginas con contenido despues de esta
          $minima = ($datos[count($datos)-1][0]);
          if ($minima > 1) {
            ?> <a href="?pagina=<?=$pagina+1?>"><button type="button">Siguiente p&aacute;gina</button></a> <?php
          }
          ?>
        </div>
      </div>
      <div class="margen2"></div>
      <?php include "./partefija/footer.php" ?>
    </div>
  </body>

</html>
