$(document).ready(function(){
    try{
        //comprobar si el usuario está loggeado
        if($("#pregunta").attr("data-idusuario") == null){
            deshabilitarVotos();
        }else{
            habilitarVotos();
        }
    }
    catch(error){
        alert(error);
    }

});
// permite votar al usuario
function habilitarVotos(){
    $("#ppositivo").click(function (){
        votarPositivo($(this));
    });

    $("#pnegativo").click(function (){
        votarNegativo($(this));
    });
}
//deshabilita la opción de votar
function deshabilitarVotos(){
    $(".material-icons").css("visibility", "hidden");
}
//votos a la pregunta
function votarPositivo(campo){
    enviar(campo, $("#pregunta").attr("data-idpregunta"), "votoPregunta", 1);
}

function votarNegativo(campo){
    alert("ss");
        enviar(campo, $("#pregunta").attr("data-idpregunta"), "votoPregunta", 0);
}

//votos a las respuestas
function votarPositivoRespuesta(campo){
    enviar($("#pregunta").attr("data-idpregunta"), $("#pregunta").attr("data-idusuario"), "votoRespuesta", 1);
}

function votarNegativoRespuesta(campo){
    enviar($("#pregunta").attr("data-idpregunta"), $("#pregunta").attr("data-idusuario"), "votoRespuesta", 0);
}

//funcion de envio de votos
function enviar(campo, idPregunta, tipoVoto, voto){
    var datos = {"idPregunta" : idPregunta, "comando" : tipoVoto, "valor" : voto };
    $.ajax({
        //hacemos un post al php correspondiente, que solo devuelve un mensaje si a habido un error
        type: "post",
        url: window.root + "/codigo/php/controller.php",
        data: datos,
        success: (r) => {if (r) {
            throw ("Hubo un error a la hora de procesar el voto.");
        }else{
            campo.css("visibility", "hidden");
        }
        }
    });
}

