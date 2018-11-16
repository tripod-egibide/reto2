<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tripod</title>
    <link rel="stylesheet" type="text/css" href="../codigo/css/style.css">
    <script type="text/javascript" src="../codigo/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../codigo/js/publicarPregunta/publicarPregunta.js"></script>
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
        <?php
            if(isset($_GET['resultado'])){
                ?>
                <h1>Pregunta publicada correctamente.</h1>
                <input type="text" id="comando" name="comando" value="ok" hidden>
                <?php
            }else{
                ?>
        <!--formulario que carga la pregunta al servidor -->
        <h1>Publicar una pregunta</h1>
        <div id="formulario">
            <!--manda la información del formulario -->
            <form action="/codigo/php/controller.php" method="get">
                <input type="text" id="comando" name="comando" value="publicarPregunta" hidden>
                <!--muestra un formulario predisennado de un html -->
                <?php
                include '../codigo/html/formulario.html';
                ?>
            </form>
        </div>
        <?php
            }
        ?>
    </div>
    <div class="margen2">Gap</div>
    <!--carga el footer desde un html -->
    <?php
    include "../partefija/footer.html";
    ?>
</div>
</body>
</html>