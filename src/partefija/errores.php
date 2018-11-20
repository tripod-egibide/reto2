<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <?php include "../codigo/php/estilos.php" ?>
</head>
<body>
<?php
include './header.php';

if(isset($_GET['error'])){
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
