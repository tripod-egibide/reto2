<?php
include "bbdd.php";
session_start();
//recibe comando, dependiendo del texto, ejecuta una funcion determinada.
    $comando = $_POST['comando'];
    switch ($comando){
        case "publicarPregunta":
            publicarPregunta();
            break;
        case "publicarRespuesta":
            publicarRespuesta();
            break;
        case "voto_pregunta":
            echo voto($comando);
            break;
        case "voto_respuesta":
            echo voto($comando);
            break;
        default:
            //header('Location: /partefija/errores.php?error=404');
            break;
    }
    // vota positivo o negativo a una pregunta
    function voto($comando){
        $datoBusqueda = [
            "usuario" => $_SESSION["id"],
            "pregunta" => $_POST["idPregunta"]];

        if(buscarVoto($comando, $datoBusqueda) == null){
            $datoBusqueda["voto"] = $_POST["voto"];
            insertarVoto($comando, $datoBusqueda);
        }else{
            $datoBusqueda["voto"] = $_POST["voto"];
            actualizarVoto($comando, $datoBusqueda);
        }
        return consultarVotos($comando, $_POST["idPregunta"]);

    }
    // vota positivo o negativo a una respuesta
    function votoRespuesta(){

    }

    function publicarPregunta(){
        $pregunta = [
            "usuario" => $_SESSION["id"],
            "titulo" => $_POST["titulo"],
            "mensaje" => $_POST["mensaje"]
        ];
        $idPregunta = insertarPregunta($pregunta);
        if($idPregunta == null){
            header('Location: /partefija/errores.php?error=404');
        }else{
            $listaEtiqueta = $_POST["etiqueta"];
            if($listaEtiqueta != null){
                //crear array de las etiquetas
                $etiquetas = dividirEtiquetas($listaEtiqueta);
                if(!insertarEtiqueta($etiquetas, $idPregunta)){
                    header('Location: /partefija/errores.php?error=404');
                }else{
                    header('Location: /pregunta/publicarPregunta.php?resultado=publicado');
                }
            }else{
                header('Location: /pregunta/publicarPregunta.php?resultado=publicado');
            }
        }
    }
    //divide el string de la etiqueta en varias etiquetas tomando como separador la coma ,
    function dividirEtiquetas($listaEtiqueta){
        $stringFinal = str_replace(' ', ',', $listaEtiqueta);
        $arrayPalabras = explode(',', $stringFinal);
        return $arrayPalabras;
    }

function publicarRespuesta(){
    $pregunta = [
        "usuario" => $_SESSION["id"],
        "titulo" => $_POST["titulo"],
        "mensaje" => $_POST["mensaje"],
        "pregunta" => $_POST["idPregunta"]
    ];
    $idPregunta = insertarRespuesta($pregunta);

    if($idPregunta == null){
        header('Location: /partefija/errores.php?error=404');
    }else{
        header('Location: /pregunta/pregunta.php?id='.$pregunta["pregunta"].'&resultado=publicado');
    }
}

?>