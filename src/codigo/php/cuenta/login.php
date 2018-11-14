<?php
if (isset($_POST)) {
  $datos = [
    "email" => $_POST["email"],
    "contra" => password_hash($_POST["contra"], PASSWORD_DEFAULT)
  ];
  $valido = verificarLogin($datos);
  if ($valido) {
    $_SESSION["usuario"]=password_hash($_POST["email"]);
  }
}  
?>
