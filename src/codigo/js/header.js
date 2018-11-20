function interruptorMenu() {
  if ($("#menuMovil").css("display") === "flex") {
    $("#menuMovil").css("display", "none");
  } else {
    $("#menuMovil").css("display", "flex");
  }
  // $("#menuMovil").toggle();
}
$("#botonMenu").on("click", interruptorMenu);


$("#barraBusqueda").submit(() => {
  let texto = $("#busqueda").val();
  let palabras = texto.split(" ");
  let etiquetas = [];
  palabras = palabras.filter((p) => {
    if (p.charAt(0) == "#") {
      etiquetas.push(p.replace("#", ""));
      return false;
    } else return true;
  });
  console.log(palabras, "\n")
  console.log(etiquetas, "\n")
  return false;
});