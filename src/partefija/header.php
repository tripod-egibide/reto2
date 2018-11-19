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
    include $root+"/cuenta/login.html";
    ?>
  </div>
</div>
<!-- Signin -->
<div id="modalSignin" class="modal">
  <div class="modalContenido">
    <i id="cerrarSignin" class="cerrarModal material-icons">cancel</i>
    <?php
    include $root+"/cuenta/signin.html";
    ?>
  </div>
</div>

<!-- Iconos -->
<link rel="stylesheet" href="<?php echo $root?>/iconos/iconos.css">
<!-- Fuentes -->
<link href="<?php echo $root?>/fuentes/Roboto/roboto.css" rel="stylesheet">
<link href="<?php echo $root?>/fuentes/OpenSans/OpenSans.css" rel="stylesheet">
<!-- Estilos -->
<link rel="stylesheet" type="text/css" href="<?php echo $root?>/codigo/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $root?>/codigo/css/modalBox.css">
<!-- Script de modalBox -->
<script src="<?php echo $root?>/codigo/js/cuenta/modalBox.js" type="text/javascript"></script>
<!-- Scripts globales -->
<script type="text/javascript" src="<?php echo $root?>/codigo/js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="<?php echo $root?>/codigo/js/globales.js"></script>
