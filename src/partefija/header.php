<?php
if (!isset($_SESSION)) {
  session_start();
}
$raiz = $_SERVER['DOCUMENT_ROOT'];
?>
<header class="cabecera">
  <a href="/index.php" id="logoHeader"><img src="/imagenes/bitmap.png"></a>
  <form action="" method="get" id="barraBusqueda">
      <label for="busqueda"><i class="material-icons">search</i></label>
    <input type="search"  id="busqueda"  name="" placeholder="Buscar..."/>
  </form>
  <a href="" id="ayuda"><i class="material-icons">help_outline</i></a>
  <a href="#" id="botonLogin">Log in</a>
  <a href="#" id="botonSignin">Sign in</a>
</header>

<!-- Login -->
<div id="modalLogin" class="modal">
  <div class="modalContenido">
    <i id="cerrarLogin" class="cerrarModal material-icons">cancel</i>
    <?php
    include "$raiz/cuenta/login.html";
    ?>
  </div>
</div>
<!-- Signin -->
<div id="modalSignin" class="modal">
  <div class="modalContenido">
    <i id="cerrarSignin" class="cerrarModal material-icons">cancel</i>
    <?php
    include "$raiz/cuenta/signin.html";
    ?>
  </div>
</div>


