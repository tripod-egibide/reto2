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
  <a id="logoHeader" href="/index.php"><img src="/imagenes/Logo.png"/></a>
  <form action="" method="get" id="barraBusqueda">
    <i><input type="submit" class="material-icons" value="search"/></i>
    <input type="search" id="busqueda" name="" placeholder="Buscar..."/>
  </form>
  <?php
    if (isset($_SESSION["id"])) {
      $avatar = verAvatar($_SESSION["id"]);
      ?>
      <a href="/cuenta/perfil.php?id=<?=$_SESSION["id"]?>"><img class="avatar avatarHeader" src="<?=$avatar["url_avatar"]?>"></a>
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
	<?php
	if (!isset($_SESSION["id"])) {
	?>
    <a href="#" id="botonLoginMovil">Sign in</a>
    <a href="#" id="botonSigninMovil">Sign up</a>
	<?php
	}
	if (isset($_SESSION["id"])) {
	?>
	<a href="#" id="botonLogoutMovil">Log out</a>
	<?php
	}
	?>
    <a href="/doc/Manual%20del%20Usuario.pdf" id="ayudaMovil" target="_blank"><i class="material-icons">help_outline</i></a>
</div>
<!-- Login -->
<div id="modalLogin" class="modal">
  <div class="modalContenido">
    <?php
    include "$raiz/cuenta/signin.html";
    ?>
    <i id="cerrarLogin" class="cerrarModal material-icons">cancel</i>
  </div>
</div>
<!-- Signin -->
<div id="modalSignin" class="modal">
  <div class="modalContenido">
    <?php
    include "$raiz/cuenta/signup.html";
    ?>
      <i id="cerrarSignin" class="cerrarModal material-icons">cancel</i>
  </div>
</div>
<!-- Script de modalBox -->
<script src="/codigo/js/cuenta/modalBox.js" type="text/javascript"></script>
<!-- Script menuResponsive -->
<script src="/codigo/js/header.js" type="text/javascript"></script>
