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
            include "./cuenta/login.html";
            ?>
  </div>
</div>
<!-- Signin -->
<div id="modalSignin" class="modal">
  <div class="modalContenido">
    <i id="cerrarSignin" class="cerrarModal material-icons">cancel</i>
    <?php
            include "./cuenta/signin.html";
            ?>
  </div>
</div>