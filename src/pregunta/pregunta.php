<?php
  require "../codigo/php/bbdd.php";
$_SESSION["id"] = 1;

  if (isset($_GET["id"])) {
    $id = $_GET["id"];
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
      <?php include "../codigo/php/estilos.php" ?>
    <link rel="stylesheet" href="../codigo/css/pregunta.css">
  </head>

  <body>
  <div class="gridContenedor">
  <?php
  include("../partefija/header.php");
  ?>
  <script type="text/javascript" src="../codigo/js/pregunta/pregunta.js"></script>
    <div class="post" id="pregunta" data-idpregunta="<?=$id?>" data-idusuario="<?=$_SESSION["id"]?>">
      <div class="cabeceraPost" id="cabeceraPregunta">
        <h1 class="titulo" id="tituloPregunta">
          <?=$pregunta["titulo"]?>
        </h1>
        <!-- TODO: dar formato a la fecha o hacer un "escrito hace 3 dias y una hora" -->
        <span class="fecha"><?=$pregunta["fecha_creacion"]?></span>
        <!-- TODO: enlazar esto al perfil del usuario correspondiente -->
        <span class="autor"><a href="../cuenta/perfil.php?id=<?=$pregunta["idusuario"]?>">
          <?=$pregunta["usuario"]?> <img class="avatar" src="<?=$pregunta["url_avatar"]?>">
        </a></span>
      </div>
      <div class="votos">
          <?php
          echo (isset($_SESSION["id"]) ? "<i class='material-icons' id='ppositivo'>arrow_drop_up</i>" :  "");
          ?>
        <span id="votoPregunta" class="votosContador"><?php echo $pregunta["positivos"]-$pregunta["negativos"]; ?></span>
          <?php
          echo (isset($_SESSION["id"]) ? "<i class='material-icons' id='pnegativo'>arrow_drop_down</i>" :  "");
          ?>
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
            ?>
            <li class=etiqueta><a href="/index.php?etiquetas=<?=strtolower($etiquetas["etiqueta"])?>">#<?=$etiqueta["etiqueta"]?></a></li>
            <?php
          }
          ?>
        </ul>
      </div>
    </div>
<hr>
    <?php
    if(isset($_GET['resultado'])){
        ?>
        <h1>Respuesta publicada correctamente.</h1>
        <input type="text" id="comando" name="comando" value="ok" hidden>
        <?php
    }else if(isset($_SESSION["id"])){
        ?>
        <!--formulario que carga la pregunta al servidor -->
        <h1 id="tituloFormulario">Publicar nueva respuesta</h1>
        <div id="formulario">
            <!--manda la informacion del formulario -->
            <form action="/codigo/php/controller.php" method="post">
                <!-- ANNADIR AQUI PARA LA AMPLIACION DEL MODIFICAR -->
                    <input type="text" id="idPregunta" name="idPregunta" value="<?=$id?>" hidden>
                <input type="text" id="comando" name="comando" value="publicarRespuesta" hidden>
                <!--muestra un formulario predisennado de un html -->
                <?php
                include '../codigo/html/formulario.html';
                ?>
            </form>
        </div>
        <?php
          }
        while ($respuesta = $respuestas->fetch()) {
        ?>

    <div class="post respuesta">
      <div class="cabeceraPost">
        <h2 class="titulo">
          <?=$respuesta["titulo"]?>
        </h2>
        <span class="fecha"><?=$respuesta["fecha_creacion"]?></span>
        <span class="creador"><a href="../cuenta/perfil.php?id=<?=$respuesta["idusuario"]?>"><?=$respuesta["usuario"]?></a></span>
        <img class="avatar" src="<?=$respuesta["url_avatar"]?>">
      </div>
      <div class="votos votoRespuesta" data-idrespuesta="<?=$respuesta['idrespuesta']?>">
          <?php
          echo (isset($_SESSION["id"]) ? "<i class=\"material-icons respuestaPositivo\">arrow_drop_up</i>" :  "");
          ?>
        <span class="votosContador" id="respuesta<?=$respuesta["idrespuesta"]?>"><?php echo $respuesta["positivos"]-$respuesta["negativos"] ?></span>
          <?php
          echo (isset($_SESSION["id"]) ? "<i class=\"material-icons respuestaNegativo\">arrow_drop_down</i>" :  "");
          ?>
        <?php
        if ($respuesta["resuelve"]) {
          echo '<i class="material-icons check">check_circle</i>';
        }
        ?>
      </div>
      <p class="cuerpo"><?=$respuesta["texto"]?></p>
    </div>
    <?php
    }
    include("../partefija/footer.php");
    ?>
  </div>
  </body>

</html>
<?php
  } else {
      header('Location: /partefija/errores.php?error=404');
  }
?>
