<?php
require "../codigo/php/bbdd.php";
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
            <?= $pregunta["titulo"] ?>
        </title>
        <?php include "../codigo/php/estilos.php" ?>
        <link rel="stylesheet" href="../codigo/css/pregunta.css">
    </head>

    <body>
    <div class="gridContenedor">
        <?php
        include("../partefija/header.php");
        if (isset($_SESSION["id"])) {
            $idSession = $_SESSION["id"];
            $sessionTrue = true;
        } else {
            $idSession = "";
            $sessionTrue = false;
        }
        ?>
        <script type="text/javascript" src="../codigo/js/pregunta/pregunta.js"></script>
        <div class="main">
            <div class="post" id="pregunta" data-idpregunta="<?= $id ?>" data-idusuario="<?= $idSession ?>">
                <div class="cabeceraPost" id="cabeceraPregunta">
                  <div class="votos">
                      <?php
                      echo ($sessionTrue) ? "<i class='material-icons' id='ppositivo'>arrow_drop_up</i>" : "";
                      ?>
                      <span id="votoPregunta"
                            class="votosContador"><?php echo $pregunta["positivos"] - $pregunta["negativos"]; ?></span>
                      <?php
                      echo ($sessionTrue) ? "<i class='material-icons' id='pnegativo'>arrow_drop_down</i>" : "";
                      ?>
                  </div>
                  <h1 class="titulo" id="tituloPregunta">
                      <?= $pregunta["titulo"] ?>
                  </h1>
                </div>
                <div class="autor">
                  <span class="fecha">el <?=$pregunta["fecha_creacion"]?> por</span>
                  <a class="imagenAutor" href="/cuenta/perfil.php?id=<?=$pregunta["idusuario"]?>">
                    <?=$pregunta["usuario"]?> <img class="avatar" src="<?=$pregunta["url_avatar"]?>">
                  </a>
                </div>
                <ul class="etiquetas">
                  <?php
                  foreach ($etiquetas as $etiqueta) {
                      ?>
                      <li class=etiqueta><a href="/index.php?etiquetas=<?= strtolower($etiqueta["etiqueta"]) ?>">
                        #<?= $etiqueta["etiqueta"] ?>
                      </a></li>
                      <?php
                  }
                  ?>
                </ul>
                <p class="cuerpo"><?=$pregunta["texto"] ?></p>
            </div>
            <?php
            if (isset($_GET['resultado'])) {
                ?>
                <h1>Respuesta publicada correctamente.</h1>
                <input type="text" id="comando" name="comando" value="ok" hidden>
                <?php
            } else if (isset($_SESSION["id"])) {
                ?>
                <!--formulario que carga la pregunta al servidor -->
                <h1 id="tituloFormulario">Publicar nueva respuesta</h1>
                <div id="formulario">
                    <!--manda la informacion del formulario -->
                    <form action="/codigo/php/controller.php" method="post">
                        <input type="text" id="idPregunta" name="idPregunta" value="<?= $id ?>" hidden>
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
                      <div class="votos votoRespuesta" data-idrespuesta="<?= $respuesta['idrespuesta'] ?>">
                          <?php
                          echo ($sessionTrue) ? "<i class=\"material-icons respuestaPositivo\">arrow_drop_up</i>" : "";
                          ?>
                          <span class="votosContador" id="respuesta<?= $respuesta["idrespuesta"] ?>"><?php echo $respuesta["positivos"] - $respuesta["negativos"] ?></span>
                          <?php
                          echo ($sessionTrue) ? "<i class=\"material-icons respuestaNegativo\">arrow_drop_down</i>" : "";
                          ?>
                      </div>
                        <h2 class="titulo">
                            <?= $respuesta["titulo"] ?>
                            <?php
                            if ($respuesta["resuelve"]) {
                                echo '<i class="material-icons check">check</i>';
                            }
                            ?>
                        </h2>
                    </div>
                    <div class="autor">
                      <span class="fecha">el <?=$respuesta["fecha_creacion"]?> por</span>
                      <a class="imagenAutor" href="/cuenta/perfil.php?id=<?=$respuesta["idusuario"]?>">
                        <?=$respuesta["usuario"]?> <img class="avatar" src="<?=$respuesta["url_avatar"]?>">
                      </a>
                    </div>
                    <p class="cuerpo"><?= $respuesta["texto"] ?></p>
                    <?php
                    if ($pregunta["idusuario"] == $idSession) {
                        $texto = ($respuesta["resuelve"] == 0) ? "Responde mi pregunta" : "No resuelta";
                        echo "<input class='resuelve' type='submit' value='$texto'>";
                    }
                    ?>
                </div>
                <?php
            }
            ?>
            <div class="navegacion"></div>
        </div>
        <div class="margen"><?php include "../partefija/margen.php"; ?></div>
        <?php
        include "../partefija/footer.php";
        ?>
    </div>
    </body>
    </html>
    <?php
} else {
    header('Location: /partefija/errores.php?error=404');
}
?>
