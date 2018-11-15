<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tripod</title>
    <link rel="stylesheet" type="text/css" href="../codigo/css/style.css">
</head>
<body>
<div class="gridContenedor">
<!-- carga la cabecera desde un html-->
    <div class="cabecera">
        <?php
        include "../partefija/header.php";
        ?>
    </div>
    <div class="margen">Gap</div>
    <div class="main">
        <!--formulario que carga la pregunta al servidor -->
        <h1>Publicar una pregunta</h1>
        <div id="formulario">
            <!--manda la información del formulario -->
                <form action="../codigo/php/ddbb.php" method="post" id="publicarPregunta">
                ?php
                <!--muestra un formulario predisennado de un html -->
                include '../codigo/html/formulario.html';
                ?>
            </form>
        </div>
    </div>
    <div class="margen2">Gap</div>
    <!--carga el footer desde un html -->
    <?php
    include "../partefija/footer.html";
    ?>
</div>
</body>
</html>