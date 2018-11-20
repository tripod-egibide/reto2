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
        case "votoPregunta":
            votoPregunta();
            break;
        case "votoRespuesta":
            votoRespuesta();
            break;
        default:
            //header('Location: /partefija/errores.php?error=404');
            break;
    }
    // vota positivo o negativo a una pregunta
    function votoPregunta(){

        $voto = [
            "usuario" => $_SESSION["id"],
            "pregunta" => $_POST["idPregunta"],
            "valor" => $_POST["valor"]
        ];
        if(buscarVoto("voto_pregunta",$_SESSION["id"], $_POST["idPregunta"])== 1){
            actualizarVoto($voto);
        }else{
            insertarVoto($voto);
        }
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
            if($_POST["etiqueta"] != null){
                //crear array de las etiquetas
                $etiquetas = dividirEtiquetas();
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
    function dividirEtiquetas(){
        $stringFinal = str_replace(' ', ',', $_POST["etiqueta"]);
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
        header('Location: /pregunta/respuesta.php?resultado=publicado');
    }
}

?>