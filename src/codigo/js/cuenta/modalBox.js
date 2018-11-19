var m = document.getElementById("modalLogin");

$('#botonLogin, #cerrarLogin').on("click", function() {
    $('#modalLogin').toggle();
});
$('#botonSignin, #cerrarSignin').on("click", function() {
    $('#modalSignin').toggle();
});

$(window).on("click", function (event) {
    if(event.currentTarget === $("#modalLogin")){
        $('#modalLogin').hide();
    }
});
/*
$(window).on("click", function(event) {
    if (event.target == $("#modalLogin")) {
        $('#modalLogin').hide();
    }
    if (event.target == $('#modalSignin')) {
        $('#modalSignin').hide();
    }
});
*/