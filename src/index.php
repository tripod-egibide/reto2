<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
</head>
<body>
    <div class="gridContenedor">
        <div class="cabecera">
            <?php include "./partefija/header.php" ?>
        </div>
        <div class="margen">Gap</div>
        <div class="main">
          <a href="http://localhost/pregunta/publicarPregunta.php">Publicar Pregunta</a>
          <?php
          require "codigo/php/bbdd.php";
          $datos = cargarIndex((isset($_GET["pagina"]) ? $_GET["pagina"] : null));
          // $datos[0]["hola"] = cargarEtiquetas(1);
          var_dump($datos[2]);
          ?>
        </div>
        <div class="margen2">Gap</div>
            <?php include "./partefija/footer.html" ?>
    </div>
</body>
</html>
