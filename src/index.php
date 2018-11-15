<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <!-- Iconos -->
    <link rel="stylesheet" href="iconos/iconos.css">
    <!-- Fuentes -->
    <link href="./fuentes/Roboto/roboto.css" rel="stylesheet">
    <link href="./fuentes/OpenSans/OpenSans.css" rel="stylesheet">
    <!-- Estilos -->
    <link rel="stylesheet" type="text/css" href="./codigo/css/style.css">
    <link rel="stylesheet" type="text/css" href="./codigo/css/modalBox.css">
</head>
<body>
    <div class="gridContenedor">
        <div class="cabecera">
            <a href="#" id="botonLogin">Log in</a>
            <a href="#" id="botonSignin">Sign in</a>
        </div>
        <div class="margen">Gap</div>
        <div class="main">Main</div>
        <div class="margen2">Gap</div>
            <?php
            include "./partefija/footer.html";
            ?>
    </div>
    <!-- Login -->
    <div id="modalLogin" class="modal">
        <div class="modalContenido">
            <i id="cerrarLogin" class="cerrarModal material-icons">cancel</i>
            <?php
            include "./cuenta/login.html";
            ?>
        </div>
    </div>
    <!-- Signin -->
    <div id="modalSignin" class="modal">
        <div class="modalContenido">
            <i id="cerrarSignin" class="cerrarModal material-icons">cancel</i>
            <?php
            include "./cuenta/signin.html";
            ?>
        </div>
    </div>
    <!-- Script About -->
    <script src="./codigo/js/cuenta/modalBox.js" type="text/javascript"></script>
</body>
</html>
