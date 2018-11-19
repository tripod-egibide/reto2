<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <!-- Iconos -->
    <link rel="stylesheet" href="../iconos/iconos.css">
    <!-- Favicon -->
    <link rel="icon" href="../imagenes/favicon.ico" type="image/ico" sizes="any">
    <!-- Fuentes -->
    <link href="../fuentes/Roboto/roboto.css" rel="stylesheet">
    <link href="../fuentes/OpenSans/OpenSans.css" rel="stylesheet">
    <!-- Estilos -->
    <link rel="stylesheet" type="text/css" href="../codigo/css/style.css">
    <link rel="stylesheet" type="text/css" href="../codigo/css/modalBox.css">
</head>
<body>
<?php
include './header.php';

if(isset($_GET['error'])){
    include '../codigo/php/estilos.php';
    switch($_GET['error']){
        case 404:
            echo '<h1 class="error">Error 404</h1>';
            break;
        case 500:
            echo '<h1 class="error">Error 500</h1>';
            break;
        default:
            echo '<h1 class="error">No sabemos de que error nos hablas.<br>Lo sentimos.</h1>';
            break;
    }
}else{
    echo '<h1 class="error">No encontramos ningún error.</h1>';
}
include './footer.php';
?>
</body>
</html>
