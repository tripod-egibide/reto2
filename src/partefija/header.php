<?php
session_start();
?>
<header>
  <a href="" id="logo"><img src="" /></a>
  <form action="" method="get">
    <input type="search" id="" name="" />
  </form>
  <a href="" id="ayuda"><img src="" /></a>
  <a href="#" id="botonLogin">Log in</a>
  <a href="#" id="botonSignin">Sign in</a>
</header>

<!-- Login -->
<div id="modalLogin" class="modal">
  <div class="modalContenido">
    <i id="cerrarLogin" class="cerrarModal material-icons">cancel</i>
    <?php
    include "../cuenta/login.html";
    ?>
  </div>
</div>
<!-- Signin -->
<div id="modalSignin" class="modal">
  <div class="modalContenido">
    <i id="cerrarSignin" class="cerrarModal material-icons">cancel</i>
    <?php
    include "../cuenta/signin.html";
    ?>
  </div>
</div>

<!-- Iconos -->
<link rel="stylesheet" href="iconos/iconos.css">
<!-- Fuentes -->
<link href="./fuentes/Roboto/roboto.css" rel="stylesheet">
<link href="./fuentes/OpenSans/OpenSans.css" rel="stylesheet">
<!-- Estilos -->
<link rel="stylesheet" type="text/css" href="./codigo/css/style.css">
<link rel="stylesheet" type="text/css" href="./codigo/css/modalBox.css">
<!-- Script de modalBox -->
<script src="./codigo/js/cuenta/modalBox.js" type="text/javascript"></script>
<!-- Scripts globales -->
<script type="text/javascript" src="../codigo/js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="../codigo/js/globales.js"></script>
