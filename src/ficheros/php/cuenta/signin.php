<?php
if (isset($_POST)) {
  require "../bbdd.php";
  //verificamos que el nombre de usuario y correo sean nuevos
  $datos = [
    "usuario" => $_POST["usuario"],
    "email" => $_POST["email"]
  ];
  $consulta = realizarConsulta("select idusuario from usuario where usuario=:usuario or email=:email", $datos);
  if (!$consulta->fetch()) {
    //si lo son, seguimos y verificamos que las contraseñas realmente coincidan
    if ($_POST["contra"] == $_POST["contra2"]) {
      //y si lo hacen, hacemos el insert
      $datos = [
        "usuario" => $_POST["usuario"],
        "email" => $_POST["email"],
        "contrasenna" => password_hash($_POST["contra"], PASSWORD_DEFAULT)
      ];
      realizarConsulta("insert into usuario values (NULL, :usuario, :email, :contrasenna, NULL, NULL)", $datos);
    }
    else {
      echo "Las contrase&ntilde;as no coinciden.";
    }
  } else {
    echo "El usuario o direcc&oacute;n de correo introducidos ya est&aacute;n en uso.";
  }
}
 ?>
