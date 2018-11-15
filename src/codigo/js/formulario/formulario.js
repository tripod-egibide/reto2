$(document).ready(function (){
    $("#titulo").focus();
    $("#titulo").on("blur", titulo);
    // se inserta esta propiedad y en la funcion titulo para restringir mejor
    $("#bEnviar").prop("disabled", true);
});

function titulo(){
    if(!/^[A-Z][a-z ]+( [A-Z]*[a-z]*)*$/.test($("#titulo").val())){
        //repito comando por si el user cambia el título
        $("#bEnviar").prop("disabled", true);
        alert("El título debe comenzar con una mayúscula y seguido de minúsculas");
        seleccion($("#titulo"));
    }else{
        $("#bEnviar").prop("disabled", false);
    }
}
//se debe asignar un timer, porque asignar el focus al campo se queda en el alert y no sabemos el tiempo que tardará el usuario en aceptar el alert.
//y como se queda en ejecución hasta recibir el campo el focus, no habría problema si el usuario tardase minutos en cerrar el alert.
function seleccion(dato){
    var inter = setInterval(
        function(){
            $(dato).focus();
            if($(dato).focusin()){
                clearInterval(inter);
            }
        }, 100);
}
