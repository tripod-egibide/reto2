function interruptorMenu() {
  if ($("#menuMovil").css("display") === "flex") {
    $("#menuMovil").css("display", "none");
  } else {
    $("#menuMovil").css("display", "flex");
  }
  // $("#menuMovil").toggle();
}
$("#botonMenu").on("click", interruptorMenu);

$("#botonLogout").on("click", (data) => {
  $.post("/codigo/php/cuenta/signout.php");
  $.ajax({
      type: "POST",
      url: "/codigo/php/cuenta/signout.php"
    })
    .done(() => window.location.reload());

})

$("#barraBusqueda").submit(() => {
  let texto = $("#busqueda").val();
  let palabras = texto.split(" ");
  let etiquetas = [];
  //recorremos las palabras
  palabras = palabras.filter((p) => {
    //si empiezan con un # es una etiqueta, y las movemos al array correspondiente
    if (p.charAt(0) == "#") {
      etiquetas.push(p.replace("#", "").toLowerCase());
      return false;
    } else return true;
  });

  let url = "/?";
  let palabrasBool = false;
  if (palabras.size >= 0 || palabras[0]) {
    url += "busqueda=";
    palabras.forEach((p) => url += p.toLowerCase() + ",");
    url = url.slice(0, -1);
    palabrasBool = true;
  }

  if (etiquetas.size >= 0 || etiquetas[0]) {
    if (palabrasBool) {
      url += "&";
    }
    url += "etiquetas=";
    etiquetas.forEach((e) => url += e + ",");
    url = url.slice(0, -1);
  }

  window.location.href = url;
  return false;
});