$(document).ready(function(){
    try{

        var tiempo = setInterval(
            function(){
                if($("#comando").val() == ("ok")){
                    location.href="/";
                }else{
                    clearInterval(tiempo);
                }

            }, 2000);

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
    $(".resuelve").click(function (){
        resuelto($(this).parent().children('.cabeceraPost').children('.votoRespuesta').attr("data-idrespuesta"), $(this).val());
        var estado = ($(this).val() == "No resuelta") ? "Responde mi pregunta" : "No resuelta";
        $(this).parent().children('.resuelve').attr("value", estado);
    });
    $("#ppositivo").click(function (){
        votarPositivo($("#pregunta").attr("data-idpregunta"), "voto_pregunta");
        $(this).addClass("votado");
        $("#pnegativo").removeClass("votado");
    });
    $("#pnegativo").click(function (){
        votarNegativo($("#pregunta").attr("data-idpregunta"), "voto_pregunta");
        $(this).addClass("votado");
        $("#ppositivo").removeClass("votado");
    });
    $(".respuestaPositivo").click(function (){
        votarPositivo($(this).parent().attr("data-idrespuesta"), "voto_respuesta", $(this).parent().children('.votosContador'));
        $(this).addClass("votado");
        $(this).parent().children('.respuestaNegativo').removeClass("votado");
    });
    $(".respuestaNegativo").click(function (){
        votarNegativo($(this).parent().attr("data-idrespuesta"), "voto_respuesta",$(this).parent().children('.votosContador'));
        $(this).addClass("votado");
        $(this).parent().children('.respuestaPositivo').removeClass("votado");
    });
}
//deshabilita la opción de votar
function deshabilitarVotos(){
    $(".material-icons").css("visibility", "hidden");
}
//votos a la pregunta
function votarPositivo(iddato, dato, campo){
    enviar( iddato, dato, 1, campo);
}
function votarNegativo(iddato, dato, campo){
    enviar( iddato, dato, 0, campo);
}
//responde la respuesta
function resuelto(idRespuesta, estado){
    var est = (estado == "No resuelta") ? 0 : 1;

    $.ajax({
        //hacemos un post al php correspondiente, que solo devuelve un mensaje si a habido un error
        type: "post",
        url: window.root + "/codigo/php/controller.php",
        data: {comando:"resuelta", dato:idRespuesta, estado:est},
        success: (r) => {
            if (r != 1) {
                //si hay un mensaje, lo mostramos por pantalla y vaciamos los campos de contrasenna
                throw "error al marcar como respondido";

            }
        }

    });
}
//funcion de envio de votos
function enviar(idPregunta, tipoVoto, voto, campo){
    var datos = {"idPreguntaRespuesta" : idPregunta, "comando" : tipoVoto, "voto" : voto };
    $.ajax({
        //hacemos un post al php correspondiente, que solo devuelve un mensaje si a habido un error
        type: "post",
        url: window.root + "/codigo/php/controller.php",
        data: datos,
        success: function(data){
            (!campo)? $("#votoPregunta").text(data) : campo.text(data);
        }

    });
}
