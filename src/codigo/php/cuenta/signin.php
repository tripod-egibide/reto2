<?php
session_start();
require "../bbdd.php";
if (isset($_POST)) {
  $id = verificarLogin($_POST["email"], $_POST["contra"]);
  if ($id) {
    $_SESSION["id"]=$id;
    echo true;
  } else {
    echo "Los datos introducidos no coinciden, por favor intenta de nuevo.";
  }
}
?>
