<?php
include "bbdd.php";

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
        $dato = [
            "usuario" => $_SESSION['usuario'],
            "titulo" => $_GET["titulo"],
            "mensaje" => $_GET["mensaje"]
        ];
        if(insertarPregunta($dato) == null){
            header('Location: /index.php?error=404');
        }else{
            header('Location: /pregunta/publicarPregunta.php?resultado=publicado');
        }

    }
?>