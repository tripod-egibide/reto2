var modalLogin = document.getElementById('modalLogin');
var modalSignin = document.getElementById('modalSignin');
var botonLogin  = document.getElementById("botonLogin");
var botonSignin = document.getElementById("botonSignin");
var cerrarSignin = document.getElementById("cerrarSignin");
var cerrarLogin = document.getElementById("cerrarLogin");

botonLogin.onclick = function() {
    modalLogin.style.display = "block";
};
botonSignin.onclick = function() {
    modalSignin.style.display = "block";
};

cerrarSignin.onclick = function() {
    modalSignin.style.display = "none";
};
cerrarLogin.onclick = function() {
    modalLogin.style.display = "none";
};

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};