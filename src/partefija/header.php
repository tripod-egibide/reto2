<!-- Scripts globales -->
<script type="text/javascript" src="/codigo/js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="/codigo/js/globales.js"></script>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$raiz = $_SERVER['DOCUMENT_ROOT'];
?>
<header>
  <a href="/index.php" id="logoHeader"><img src="/imagenes/bitmap.png"></a>
  <form action="" method="get" id="barraBusqueda">
    <i><input type="submit" class="material-icons" value="search"/></i>
    <input type="search" id="busqueda" name="" placeholder="Buscar..."/>
  </form>
  <a href="/doc/Manual%20del%20Usuario.pdf" id="ayuda" target="_blank"><i class="material-icons">help_outline</i></a>
  <?php
    if (isset($_SESSION["id"])) {
      ?>
      <a href="#" id="botonLogout">Log out</a>
      <?php
    } else {
      ?>
      <a href="#" id="botonLogin">Sign in</a>
      <a href="#" id="botonSignin">Sign up</a>
      <?php
    }
   ?>

  <a href="#" id="botonMenu"><i class="material-icons">menu</i></a>
</header>
<div id="menuMovil">
    <a href="#" id="botonLoginMovil">Sign in</a>
    <a href="#" id="botonSigninMovil">Sign up</a>
    <a href="/doc/Manual%20del%20Usuario.pdf" id="ayudaMovil" target="_blank"><i class="material-icons">help_outline</i></a>
</div>
<!-- Login -->
<div id="modalLogin" class="modal">
  <div class="modalContenido">
    <i id="cerrarLogin" class="cerrarModal material-icons">cancel</i>
    <?php
    include "$raiz/cuenta/signin.html";
    ?>
  </div>
</div>
<!-- Signin -->
<div id="modalSignin" class="modal">
  <div class="modalContenido">
    <i id="cerrarSignin" class="cerrarModal material-icons">cancel</i>
    <?php
    include "$raiz/cuenta/signup.html";
    ?>
  </div>
</div>
<!-- Script de modalBox -->
<script src="/codigo/js/cuenta/modalBox.js" type="text/javascript"></script>
<!-- Script menuResponsive -->
<script src="/codigo/js/header.js" type="text/javascript"></script>
