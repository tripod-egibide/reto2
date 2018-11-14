//al hacer submit
$("#login").submit(() => {
  $.ajax({
    //hacemos un post al php correspondiente, que solo devuelve un mensaje si ha habido un error
    type: "post",
    url: window.root + "/codigo/php/cuenta/login.php",
    data: $("#login").serialize(),
    success: (r) => {
      if (!r) {
        //los datos son incorrectos mostramos un mensaje de error
        $("#resultado").html("Los datos introducidos son incorrectos.");
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