<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="./ficheros/css/style.css">
</head>
<body>
    <div class="gridContenedor">
        <div class="cabecera">Header
            <?php
            include "./partefija/header.html";
            ?>
        </div>
        <div class="margen">Gap</div>
        <div class="main">Main</div>
        <div class="margen2">Gap</div>
            <?php
            include "./partefija/footer.html";
            ?>
    </div>
</body>
</html>
