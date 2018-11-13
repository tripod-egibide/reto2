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
    <div class="cabecera">
        <?php
        include "../partefija/header.html";
        ?>
    </div>
    <div class="margen">Gap</div>
    <div class="main">
        <h1>Publicar una pregunta</h1>
        <div id="formulario">

                <<form action="../codigo/php/ddbb.php" method="post" id="publicarPregunta">?php
                include '../codigo/html/formulario.html';
                ?>
            </form>
        </div>
    </div>
    <div class="margen2">Gap</div>
    <?php
    include "../partefija/footer.html";
    ?>
</div>
</body>
</html>