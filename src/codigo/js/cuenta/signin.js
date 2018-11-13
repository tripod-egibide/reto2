// TODO: verificacion de datos


//al hacer submit
$("#signin").submit((event) => {
  let status;
  //llamamos al fichero php correspondiente, y mostramos el resultado en pantalla
  $.post(window.root + "/ficheros/php/cuenta/signin.php", $("#signin").serialize(), ((r) => status = r));
  if (!status) {
    //si el resultado no tiene datos, la insercion funciono, y volvemos al index
    // TODO: verificar que este sea el comportamiento adecuado, y si no, corregir
    $(location).attr(window.root);
  } else {
    //si tiene datos entonces hubo un problema, que mostramos en pantalla y luego limpiamos las contrasennas
    $("#resultado").html(r)
    $(".contra").val("");
    return false;
  }
});