function interruptorMenu() {
    if ($("#menuMovil").css("display") === "flex") {
        $("#menuMovil").css("display", "none");
    } else {
        $("#menuMovil").css("display", "flex");
    }
    // $("#menuMovil").toggle();
}
$("#botonMenu").on("click", interruptorMenu);