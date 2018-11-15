<?php
    $comando = $_GET['comando'];
    switch ($comando){
        case "publicarPregunta":
            publicarPregunta();
            break;
        default:
            header('Location: /index.php?error=404');
            break;
    }

    function publicarPregunta(){
        $dato = "accion=publicarPregunta&titulo=" . $_GET['titulo'] . "&mensaje=" . $_GET['mensaje']. "&etiqueta=" . $_GET['etiqueta'];

        //sql
        header('Location: bbdd.php?'.$dato);
        //header('Location: /pregunta/publicarPregunta.php?resultado=publicado');

    }
?>