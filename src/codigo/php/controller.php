<?php
    $comando = $_POST['comando'];
    switch ($comando){
        case "publicarPregunta":
            publicarPregunta();
            break;
        default:
            header('Location: /index.php?error=404');
            break;
    }

    function publicarPregunta(){
        $dato = "titulo=" . $_POST['titulo'] . "mensaje=" . $_POST['mensaje']. "etiqueta=" . $_POST['etiqueta'];

        //sql
        ?>
        <form id=”insertarPregunta” method=”GET” action=”bbdd.php?dato=<?php $dato ?>”></form>
        <?php

        header('Location: /pregunta/publicarPregunta.php?resultado=publicado');

    }
?>