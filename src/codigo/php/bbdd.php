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

function insertarPregunta($datos) {
    return realizarConsulta("insert into usuario values (NULL, :usuario, :email, :contrasenna, NULL, NULL)", $datos);
}

function cargarPregunta($id) {
  // TODO: falta modificar las selects para cargar tambien el contador de votos
  $pregunta = realizarConsulta("
  select p.*,
   (select count(*) from voto_pregunta where idpregunta=:id and positivo=1) as positivos,
    (select count(*) from voto_pregunta where idpregunta=:id and positivo!=1) as negativos
     from pregunta as p where idpregunta=:id;", ["id" => $id])->fetch();
  $respuestas = realizarConsulta("select r.*,
  (select count(*) from voto_respuesta where idrespuesta=r.idrespuesta and positivo=1) as positivos,
    (select count(*) from voto_respuesta where idrespuesta=r.idrespuesta and positivo!=1) as negativos
      from respuesta as r where idpregunta=:id order by idrespuesta;", ["id" => $id]);
  $etiquetas = realizarConsulta("select etiqueta from etiqueta where idetiqueta in (select idetiqueta from categoria where idpregunta=:id)", ["id" => $id]);
  $datos = [
    "pregunta" => $pregunta,
    "respuestas" => $respuestas,
    "etiquetas" => $etiquetas
  ];
  return $datos;
}
?>
