<?php
require "../bbdd.php";
if (isset($_POST)) {
  $id = verificarLogin($_POST["email"], $_POST["contra"]);
  if ($id) {
    $_SESSION["usuario"]=$id;
  }
}
?>
