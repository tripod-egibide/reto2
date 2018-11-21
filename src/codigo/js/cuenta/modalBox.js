var login = document.getElementById("modalLogin");
var signin = document.getElementById("modalSignin");

$('#botonLogin, #botonLoginMovil, #cerrarLogin').on("click", function() {
    $('#modalLogin').toggle();
});
$('#botonSignin, #botonSigninMovil, #cerrarSignin').on("click", function() {
    $('#modalSignin').toggle();
});

$(window).on("click", function (event) {
    if(event.target === login){
        $('#modalLogin').hide();
    }
    if(event.target === signin){
        $('#modalSignin').hide();
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