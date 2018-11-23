<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tripod</title>
    <?php
    include "../codigo/php/estilos.php";
    include "../codigo/php/bbdd.php";
    ?>
</head>
<body>
<div class="gridContenedor">
<!-- carga la cabecera desde un html-->
    <?php
    include "../partefija/header.php";
    ?>
    <script type="text/javascript" src="/codigo/js/pregunta/publicarPregunta.js"></script>
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
            <form action="/codigo/php/controller.php" method="post">
                <!-- ANNADIR AQUI PARA LA AMPLIACION DEL MODIFICAR -->
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
    <!--carga el footer desde un html -->
    <?php
    include "../partefija/footer.php";
    ?>
</div>
</body>
</html>
