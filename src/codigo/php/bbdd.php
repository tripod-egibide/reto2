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

function ultimaPregunta(){
  return abrirConexion()->query("SELECT max(idpregunta) from pregunta")->fetch()[0];
}

function encontrarUsuario($datos) {
  return realizarConsulta("SELECT idusuario from usuario where usuario=:usuario or email=:email", $datos);
}

function insertarUsuario($datos) {
  return realizarConsulta("INSERT into usuario values (NULL, :usuario, :email, :contrasenna, NULL, NULL)", $datos);
}

function verificarLogin($email, $contrasenna) {
  $resultado = realizarConsulta("SELECT idusuario, contrasenna from usuario where email=:email", ["email" => $email])->fetch();
  if (password_verify($contrasenna, $resultado["contrasenna"])) {
    return $resultado["idusuario"];
  } else {
    return false;
  }
}

function insertarPregunta($datos) {
    return realizarConsulta("INSERT INTO pregunta	VALUES (NULL, :usuario, :titulo, :mensaje, CURRENT_TIMESTAMP);", $datos);
}

function cargarEtiquetas($idPregunta) {
  return realizarConsulta("SELECT etiqueta from etiqueta where idetiqueta in (SELECT idetiqueta from pregunta_tiene_etiqueta where idpregunta=:id)", ["id" => $idPregunta])->fetchAll();
}

function cargarPregunta($id) {
  $pregunta = realizarConsulta("SELECT p.*, u.usuario, u.url_avatar,
      (SELECT count(*) from voto_pregunta where idpregunta=:id and positivo=1) as positivos,
      (SELECT count(*) from voto_pregunta where idpregunta=:id and positivo!=1) as negativos
      from pregunta as p, usuario as u where p.idpregunta=:id and u.idusuario = p.idusuario", ["id" => $id]);
  $respuestas = realizarConsulta("SELECT r.*, u.usuario, u.url_avatar,
      (SELECT count(*) from voto_respuesta where idrespuesta=1 and positivo=1) as positivos,
      (SELECT count(*) from voto_respuesta where idrespuesta=1 and positivo!=1) as negativos
      from respuesta as r, usuario as u where r.idrespuesta=1 and u.idusuario = r.idusuario", ["id" => $id]);
  $etiquetas = cargarEtiquetas($id);
  $datos = [
    "pregunta" => $pregunta,
    "respuestas" => $respuestas,
    "etiquetas" => $etiquetas
  ];
  return $datos;
}

function cargarIndex($pagina=0) {
  $ultima = ultimaPregunta();
  $rango = [
    "maxima" => ($ultima-($pagina * 10) >= 0 ? $ultima-($pagina * 10) : 0),
    "minima" => ($ultima-(($pagina + 1) * 10)+1) >= 0 ? $ultima-(($pagina + 1) * 10)+1 : 0
  ];
  $preguntas = realizarConsulta("SELECT p.idpregunta, p.titulo, p.fecha_creacion,
  	(select count(*) from respuesta where idpregunta=p.idpregunta) as respuestas,	u.idusuario, u.usuario
    from pregunta as p, usuario as u where p.idusuario=u.idusuario and p.idpregunta between :minima and :maxima
    order by p.idpregunta desc", $rango)->fetchAll();

  $annadirEtiquetas = function($pregunta) {
    $pregunta["etiquetas"] = cargarEtiquetas($pregunta[0]);
    return $pregunta;
  };

  return array_map($annadirEtiquetas, $preguntas);
}
?>
