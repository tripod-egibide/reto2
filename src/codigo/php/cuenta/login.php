<?php
if (isset($_POST)) {
  require "../bbdd.php";
  //llamamos a esta funcion, que verifica los datos y devuelve el ID o un falso
  $id = verificarLogin($_POST["email"], $_POST["contra"]);
  if ($id) {
    //si devolvio una id, la almacenamos en sesion
    $_SESSION["usuario"]=$id;
    echo true;
  } else {
    //si no, devolvemos un falso
    echo false;
  }
}
?>
