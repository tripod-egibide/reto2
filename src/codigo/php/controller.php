<?php
include "bbdd.php";
session_start();

    $comando = $_POST['comando'];
    switch ($comando){
        case "publicarPregunta":
            publicarPregunta();
            break;
        case "modificarPregunta":
            modificarPregunta();
            break;
        default:
            header('Location: /error.php?iderror=404');
            break;
    }

    function publicarPregunta(){
        $pregunta = [
            "usuario" => $_SESSION["id"],
            "titulo" => $_POST["titulo"],
            "mensaje" => $_POST["mensaje"]
        ];
        $idPregunta = insertarPregunta($pregunta);

        if($idPregunta == null){
            header('Location: /error.php?iderror=404');
        }else{
            if($_POST["etiqueta"] != null){
                //crear array de las etiquetas
                $etiquetas = dividirEtiquetas();
                if(!insertarEtiqueta($etiquetas, $idPregunta)){
                    header('Location: /error.php?iderror=404');
                }else{
                    header('Location: /pregunta/publicarPregunta.php?resultado=publicado');
                }
            }else{
                header('Location: /pregunta/publicarPregunta.php?resultado=publicado');
            }
        }
    }
    //divide el string de la etiqueta en varias etiquetas tomando como separador la coma ,
    function dividirEtiquetas(){
        $stringFinal = str_replace(' ', ',', $_POST["etiqueta"]);
        $arrayPalabras = explode(',', $stringFinal);
        return $arrayPalabras;
    }
    //Pendiente de empezar
    function modificarPregunta(){
        $pregunta = [
            "usuario" => $_SESSION['usuario'],
            "titulo" => $_POST["titulo"],
            "mensaje" => $_POST["mensaje"]
        ];
        if(insertarPregunta($pregunta) == null){
            header('Location: /index.php?error=404');
        }else{
            if($_POST["etiqueta"] != null){

                $etiqueta = [
                    "usuario" => $_SESSION['usuario'],
                    "etiqueta" => $_POST["etiqueta"]
                ];
                if(insertarEtiqueta($etiqueta) == null){
                    header('Location: /index.php?error=404');
                }else{
                    header('Location: /pregunta/publicarPregunta.php?resultado=publicado');
                }
            }else{
                header('Location: /pregunta/publicarPregunta.php?resultado=publicado');
            }

        }



}
?>