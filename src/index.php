<?php // TODO: annadir un control de paginas, para que salte un 404 si la pagina estuviese vacia ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stack Underflow</title>
    <?php include "./codigo/php/estilos.php" ?>
  </head>

  <body>
    <div class="gridContenedor">
      <?php include "./partefija/header.php" ?>
      <div class="main">
        <a href="http://localhost/pregunta/publicarPregunta.php">Publicar Pregunta</a>
        <?php
        var_dump($_SESSION);
        $pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : 0;
        $mostrarPaginas = false;
        require "codigo/php/bbdd.php";
        //cargamos datos diferentes dependiendo de los datos que podemos tener en _GET
        if (isset($_GET["etiquetas"])) {
          //dividir el resultado de estas busquedas en paginas seria complicado, pero lo podemos hacer luego si tenemos tiempo
          if (isset($_GET["busqueda"])) {
            //esta es la busqueda que combina etiquetas con titulos
            $porEtiquetas = busquedaPorEtiquetas(explode(",", $_GET["etiquetas"]));
            $porPalabras = busquedaPorTexto(explode(",", $_GET["busqueda"]));
            $datos = [];
            foreach ($porEtiquetas as $preguntaEtiquetas) {
              if (in_array($preguntaEtiquetas, $porPalabras)) {
                $datos[] = $preguntaEtiquetas;
              }
            }
          } else {
            $datos = busquedaPorEtiquetas(explode(",", $_GET["etiquetas"]));
          }

        } else if (isset($_GET["busqueda"])) {
          $datos = busquedaPorTexto(explode(",", $_GET["busqueda"]));
        } else {
          $datos = cargarIndex($pagina);
          $mostrarPaginas = true;
        }


        foreach ($datos as $pregunta) {
          ?>
          <div class="pregunta">
            <?php
            if ($pregunta["resuelto"]) {
              echo '<i class="material-icons">check</i>';
            }
            ?>
            <span class="respuestas"><?php echo ($pregunta["respuestas"] == 1) ? "1 respuesta." : $pregunta["respuestas"] . " respuestas." ?></span>
            <span class="votos">
              <?php
              echo $pregunta["votos"];
              if ($pregunta["votos"] > 0) {
                echo '<i class="material-icons thumb" id="thumbUp">thumb_up</i>';
              } else if ($pregunta["votos"] < 0) {
                echo '<i class="material-icons thumb" id="thumbDown">thumb_down</i>';
              } else {
                echo '<i class="material-icons thumb" id="thumbsUpDown">thumbs_up_down</i>';
              }
              ?>
            </span>
            <div class="info">
              <span class="titulo"><a href="pregunta/pregunta.php?id=<?=$pregunta["idpregunta"]?>"><?=$pregunta["titulo"]?></a></span>
              <span class="autor"><a href="/cuenta/perfil.php?id=<?=$pregunta["idusuario"]?>">
                <?=$pregunta["usuario"]?> <img class="avatar" src="<?=$pregunta["url_avatar"]?>">
              </a></span>
              <span class="fecha"><?=$pregunta["fecha_creacion"]?></span>
            </div>
            <ul class="etiquetas">
              <?php
              foreach ($pregunta["etiquetas"] as $etiquetas) {
                ?>
                <li class=etiqueta><a href="/index.php?etiquetas=<?=strtolower($etiquetas["etiqueta"])?>">#<?=$etiquetas["etiqueta"]?></a></li>
                <?php
              }
              ?>
            </ul>
          </div>
          <?php
        }
        if ($mostrarPaginas) {
          ?>
          <div class="navegacion">
            <?php
            //si estamos en la pagina 0, no mostramos el boton de retroceder pagina
            if ($pagina>0) {
               ?> <a href="?pagina=<?=$pagina-1?>"><button type="button">P&aacute;gina anterior</button></a><?php
            }
            //buscamos la menor ID en la pagina para saber si hay mas preguntas que mostrar
            //es decir, si hay mas paginas con contenido despues de esta
            $minima = ($datos[count($datos)-1][0]);
            if ($minima > 1) {
              ?> <a href="?pagina=<?=$pagina+1?>"><button type="button">Siguiente p&aacute;gina</button></a><?php
            }
            ?>
            </div>
            <?php
        }?>
      </div>
      <div class="margen"></div>
      <?php include "./partefija/footer.php" ?>
    </div>
  </body>

</html>
