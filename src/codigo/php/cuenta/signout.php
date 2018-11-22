<?php
//no tengo ni idea de por que hay que inicializar la sesion antes de destruirla, pero si no no funciona
session_start();
session_destroy();
 ?>
