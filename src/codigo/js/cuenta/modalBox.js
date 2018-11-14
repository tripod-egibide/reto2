var modalLogin = $('#modalLogin');
var modalSignin = $('#modalSignin');
var botonLogin  = $('#botonLogin');
var botonSignin = $('#botonSignin');
var cerrarSignin = $('#cerrarSignin');
var cerrarLogin = $('#cerrarLogin');

botonLogin.on("click", function() {
    modalLogin.show();
});
botonSignin.on("click", function() {
    modalSignin.show();
});

cerrarSignin.on("click", function() {
    modalSignin.hide()
});
cerrarLogin.on("click", function() {
    modalLogin.hide();
});

window.on("click", function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
});