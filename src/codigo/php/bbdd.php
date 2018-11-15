<?php
//funciones universales:
function abrirConexion(){
  $bd = "mysql:host=localhost;dbname=reto2;charset=utf8";
  $usuario = "root";
  $contrasenna = "";
  return $conexion = new PDO($bd, $usuario, $contrasenna);
}

function realizarConsulta($query, $datos){
  $conexion = abrirConexion();
  $consulta = $conexion->prepare($query);
  $consulta->execute($datos);
  $conexion = null;
  return $consulta;
}

//funciones especificas:
function encontrarUsuario($datos) {
  return realizarConsulta("select idusuario from usuario where usuario=:usuario or email=:email", $datos);
}

function insertarUsuario($datos) {
  return realizarConsulta("insert into usuario values (NULL, :usuario, :email, :contrasenna, NULL, NULL)", $datos);
}

function verificarLogin($email, $contrasenna) {
  $resultado = realizarConsulta("select idusuario, contrasenna from usuario where email=:email", ["email" => $email])->fetch();
  if (password_verify($contrasenna, $resultado["contrasenna"])) {
    return $resultado["idusuario"];
  } else {
    return false;
  }
}
session_start();
$_SESSION['usuario'] = 1;
$comando = $_GET['accion'];

switch ($comando){

    case "publicarPregunta":
        $datos = [
            "usuario" => $_SESSION['usuario'],
            "titulo" => $_GET["titulo"],
            "mensaje" => $_GET["mensaje"],
            "etiqueta" => $_GET["etiqueta"]
        ];
      if(insertarPregunta($datos) != 1){
      ?>
        <form id=”insertarPregunta” method=”get” action=”controller.php?comando=null”></form>
          <?php

    };
        break;
    default:
        header('Location: /index.php?error=404');
        break;
}

function insertarPregunta($datos) {
    return realizarConsulta("INSERT INTO pregunta	VALUES (NULL, :usuario, :titulo, :mensaje, CURRENT_TIMESTAMP);", $datos);
}

function cargarPregunta($id) {
  // TODO: falta modificar las selects para cargar tambien el contador de votos
  $pregunta = realizarConsulta("select * from pregunta where idpregunta=:id", ["id" => $id])->fetch();
  $respuestas = realizarConsulta("select * from respuesta where idpregunta=:id order by fecha_creacion", ["id" => $id]);
  $etiquetas = realizarConsulta("select etiqueta from etiqueta where idetiqueta in (select idetiqueta from categoria where idpregunta=:id)", ["id" => $id]);
  $datos = [
    "pregunta" => $pregunta,
    "respuestas" => $respuestas,
    "etiquetas" => $etiquetas
  ];
  return $datos;
}
?>
