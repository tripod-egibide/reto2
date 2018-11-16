<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stack Underflow</title>
  </head>
  <!-- <?=$pregunta[""]?> -->

  <body>
    <div class="gridContenedor">
      <div class="cabecera">
        <?php include "./partefija/header.php" ?>
      </div>
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
            <span class="respuestas"><?php echo ($pregunta["respuestas"] == 1) ? "1 respuesta." : $pregunta["respuestas"] . " respuestas." ?></span>
            <div class="info">
              <span class="titulo"><?=$pregunta["titulo"]?></span>
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
          if ($pagina>0) {
            ?> <a href="?pagina=<?=$pagina-1?>"><button type="button">P&aacute;gina anterior</button></a> <?php
          }
          ?>
          <a href="?pagina=<?=$pagina+1?>"><button type="button">Siguiente p&aacute;gina</button></a>
        </div>
      </div>
      <div class="margen2"></div>
      <?php include "./partefija/footer.html" ?>
    </div>
  </body>

</html>
