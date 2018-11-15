<?php
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    require "../codigo/php/bbdd.php";
    $datos = cargarPregunta($id);
    $pregunta = $datos["pregunta"];
  } else {
    echo "<h1>404</h1>";
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?=$pregunta->titulo?></title>
  </head>
  <body>
    <div class="post" id="pregunta">
      <div class="cabeceraPost" id="cabeceraPregunta">
        <h1 class="titulo" id="tituloPregunta"><?=$pregunta->titulo?></h1>
        <span class="informacion" id="informacionPregunta"></span>
      </div>
      <div class="votos">
        <!-- faltarian las flechitas y la variable de los votos -->
      </div>
      <p class="cuerpo"><?=$pregunta->texto?></p>
      <div id="piePregunta">
        <span id="contadorRespuestas"></span>
        <ul id="etiquetas">
          <!-- etiquetas -->
        </ul>
      </div>
    </div>

  </body>
</html>

<?php
?>
