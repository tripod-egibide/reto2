//al hacer submit
$("#login").submit(() => {
  $.ajax({
    //hacemos un post al php correspondiente, que solo devuelve un mensaje si a habido un error
    type: "post",
    url: window.root + "/codigo/php/cuenta/login.php",
    data: $("#login").serialize(),
    success: (r) => {
      if (r) {
        //si hay un mensaje, lo mostramos por pantalla y vaciamos los campos de contrasenna
        $("#resultado").html(r);
        $("#contraLogin").val("");
      } else {
        //si no, vamos al index
        // TODO: este comportamiento es temporal, en realidad se cerraria el popup
        window.location.replace(window.root);
      }
    }
  });
  return false;
});