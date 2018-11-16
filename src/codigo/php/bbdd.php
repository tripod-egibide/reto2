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
  return abrirConexion()->query("select max(idpregunta) from pregunta")->fetch()[0];
}

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

function consultarPregunta(){

}

function insertarPregunta($datos){
  if(realizarConsulta("INSERT INTO pregunta VALUES (NULL, :usuario, :titulo, :mensaje, DEFAULT);", $datos) == null){
    return null;
  }else{
      return ultimaPregunta();
  }
}

function insertarEtiqueta($etiquetas, $idPregunta){
    $cont = false;
    foreach($etiquetas as $etiqueta){
        $etiqueta = ucfirst($etiqueta);
        if($etiqueta != ""){
            $idEtiqueta = consultarEtiqueta($etiqueta);
            if($idEtiqueta == null){
                realizarConsulta("INSERT INTO etiqueta VALUES (NULL, :etiqueta);", ["etiqueta" => $etiqueta]);
                $idEtiqueta = consultarEtiqueta($etiqueta);
                $dato = [
                    "idEtiqueta" => $idEtiqueta,
                    "idPregunta" => $idPregunta
                ];
                (realizarConsulta("INSERT INTO pregunta_tiene_etiqueta	 VALUES (:idEtiqueta, :idPregunta);", $dato)!= null ? $cont = true : $cont = false);

            }else{
                $dato = [
                    "idEtiqueta" => $idEtiqueta,
                    "idPregunta" => $idPregunta
                ];
                (realizarConsulta("INSERT INTO pregunta_tiene_etiqueta VALUES (:idEtiqueta, :idPregunta);", $dato)!= null ? $cont = true : $cont = false);
            }
        }
    }
    return $cont;
}

function consultarEtiqueta($etiqueta){
  return realizarConsulta("SELECT idetiqueta FROM ETIQUETA WHERE etiqueta = :etiqueta;", ["etiqueta" => $etiqueta])->fetch()[0];
}

function cargarPregunta($id) {
  $pregunta = realizarConsulta("
    select p.*, u.usuario, u.url_avatar,
      (select count(*) from voto_pregunta where idpregunta=:id and positivo=1) as positivos,
      (select count(*) from voto_pregunta where idpregunta=:id and positivo!=1) as negativos
      from pregunta as p, usuario as u where p.idpregunta=:id and u.idusuario = p.idusuario", ["id" => $id]);
  $respuestas = realizarConsulta("
    select r.*, u.usuario, u.url_avatar,
      (select count(*) from voto_respuesta where idrespuesta=1 and positivo=1) as positivos,
      (select count(*) from voto_respuesta where idrespuesta=1 and positivo!=1) as negativos
      from respuesta as r, usuario as u where r.idrespuesta=1 and u.idusuario = r.idusuario", ["id" => $id]);
  $etiquetas = realizarConsulta("select etiqueta from etiqueta where idetiqueta in (select idetiqueta from pregunta_tiene_etiqueta where idpregunta=:id)", ["id" => $id]);
  $datos = [
    "pregunta" => $pregunta,
    "respuestas" => $respuestas,
    "etiquetas" => $etiquetas
  ];
  return $datos;
}



function cargarIndex($pagina=0) {

}
?>
