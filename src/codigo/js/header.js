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
  alert("w")
  let texto = $("#busqueda").val();
  let palabras = texto.split(" ");
  let etiquetas = [];
  palabras.forEach((p) => {
    if (p.charAt(0) == "#") {
      etiquetas.push(p);
      palabras.filter((e) => {
        return (p == e)
      });
    }
  });
  console.log(palabras, "\n")
  console.log(etiquetas, "\n")
  return false;
})