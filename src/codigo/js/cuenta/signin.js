//al hacer submit
$("#login").submit(() => {
  $.ajax({
    //hacemos un post al php correspondiente, que solo devuelve un mensaje si a habido un error
    type: "post",
    url: window.root + "/codigo/php/cuenta/signin.php",
    data: $("#login").serialize(),
    success: (r) => {
      if (r != 1) {
        //si hay un mensaje, lo mostramos por pantalla y vaciamos los campos de contrasenna
        $("#resultadoSignIn").html(r);
        $("#contraLogin").val("");

      } else {
        //si no, vamos al index
        // TODO: este comportamiento es temporal, en realidad se cerraria el popup
        location.reload();
      }
    }
  });
  return false;
});