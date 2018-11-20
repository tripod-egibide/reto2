<!-- Scripts globales -->
<script type="text/javascript" src="/codigo/js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="/codigo/js/globales.js"></script>
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
  <a href="/doc/Manual%20del%20Usuario.pdf" id="ayuda" target="_blank"><i class="material-icons">help_outline</i></a>
  <a href="#" id="botonLogin">Sign in</a>
  <a href="#" id="botonSignin">Sign up</a>
</header>

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