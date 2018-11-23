//al hacer submit
$("#signin").submit(() => {
  $.ajax({
    //hacemos un post al php correspondiente, que solo devuelve un mensaje si ha habido un error
    type: "post",
    url: window.root + "/codigo/php/cuenta/signup.php",
    data: $("#signin").serialize(),
    datatype: "",
    success: (r) => {
      if (r) {
        //si hay un mensaje, lo mostramos por pantalla y vaciamos los campos de contrasenna
        $("#resultadoSignUp").html(r);
        $(".contra").val("");
      } else {
        //si no, vamos al index
        // TODO: este comportamiento es temporal, en realidad se cerraria el popup
        window.location.replace(window.root);
      }
    }
  });
  return false;
});