<?php
//funciones universales:
function abrirConexion(){
  $bd = "mysql:host=e101240-mysql.services.easyname.eu;dbname=u159695db1;charset=utf8";
  $usuario = "u159695db1";
  $contrasenna = "x2354057F";
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
  //devuelve la mayor ID de pregunta, que como es autoincremental siempre sera la mas reciente
  //ojo, que es en forma de string
  return abrirConexion()->query("SELECT max(idpregunta) from pregunta")->fetch()[0];
}
function encontrarUsuario($datos) {
  return realizarConsulta("SELECT idusuario from usuario where usuario=:usuario or email=:email", $datos);
}
function insertarUsuario($datos) {
  realizarConsulta("INSERT into usuario values (NULL, :usuario, :email, :contrasenna, NULL, DEFAULT)", $datos);
  return abrirConexion()->query("SELECT max(idusuario) from usuario")->fetch()[0];
}
function verificarLogin($email, $contrasenna) {
  $resultado = realizarConsulta("SELECT idusuario, contrasenna from usuario where email=:email", ["email" => $email])->fetch();
  if (password_verify($contrasenna, $resultado["contrasenna"])) {
    return $resultado["idusuario"];
  } else {
    return false;
  }
}
function ultimaRespuesta(){
    //devuelve la mayor ID de pregunta, que como es autoincremental siempre sera la mas reciente
    //ojo, que es en forma de string
    return abrirConexion()->query("SELECT max(idrespuesta) from respuesta")->fetch()[0];
}
function insertarPregunta($datos){
    //obtiene el ultimo registro
    $r = ultimaPregunta();
    //inserta registro
  if(realizarConsulta("INSERT INTO pregunta VALUES (NULL, :usuario, :titulo, :mensaje, DEFAULT);", $datos) == null){
    //si no devuelve nada, es que ha fallado
      return null;
      //compara si se ha introducido
  }
    // si introducido devuelve ultima pregunta, en caso contrario null
  $nr=ultimaPregunta();
  if($nr> $r){
      return $nr;
  }
  else{
      return null;
  }
}
function insertarEtiqueta($etiquetas, $idPregunta){
    $cont = false;
    foreach($etiquetas as $etiqueta){
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
function insertarRespuesta($datos){
    //obtiene el último registro
    $r = ultimaRespuesta();
    //inserta registro
    if(realizarConsulta("INSERT INTO respuesta VALUES (NULL, :pregunta, :usuario, :titulo, :mensaje, 0, DEFAULT);", $datos) == null){
        // si no devuelve nada, es que ha fallado
        return null;
        //comprara si se ha introducido
    }else if(ultimaRespuesta()> $r){
        //si introducido ok, en caso contrario null
        return "ok";
    } else{
        return null;
    }
}

function consultarEtiqueta($etiqueta){
  return realizarConsulta("SELECT idetiqueta FROM etiqueta WHERE etiqueta = :etiqueta;", ["etiqueta" => $etiqueta])->fetch()[0];
}

function cargarEtiquetas($idPregunta) {
  return realizarConsulta("SELECT etiqueta, idetiqueta from etiqueta where idetiqueta in (SELECT idetiqueta from pregunta_tiene_etiqueta where idpregunta=:id)", ["id" => $idPregunta])->fetchAll();
}

function cargarPregunta($id) {
  $pregunta = realizarConsulta("SELECT p.*, u.usuario, u.url_avatar,
      (SELECT count(*) from voto_pregunta where idpregunta=:id and positivo=1) as positivos,
      (SELECT count(*) from voto_pregunta where idpregunta=:id and positivo!=1) as negativos
      from pregunta as p, usuario as u where p.idpregunta=:id and u.idusuario = p.idusuario", ["id" => $id]);
  $respuestas = realizarConsulta("SELECT r.*, u.usuario, u.url_avatar,
      (SELECT count(*) from voto_respuesta where idrespuesta=r.idrespuesta and positivo=1) as positivos,
      (SELECT count(*) from voto_respuesta where idrespuesta=r.idrespuesta and positivo!=1) as negativos
      from respuesta as r, usuario as u where r.idpregunta=:id and u.idusuario = r.idusuario", ["id" => $id]);
  $etiquetas = cargarEtiquetas($id);
  $datos = [
    "pregunta" => $pregunta,
    "respuestas" => $respuestas,
    "etiquetas" => $etiquetas
  ];
  return $datos;
}

function busquedaPreguntas($where, $parametros=NULL) {
  $where = "where p.idusuario=u.idusuario and " . $where;
  $preguntas = realizarConsulta("SELECT p.idpregunta, p.titulo, p.fecha_creacion, u.idusuario, u.usuario, u.url_avatar,
  	(select count(*) from respuesta where idpregunta=p.idpregunta) as respuestas,
    (select max(resuelve) from respuesta where idpregunta=p.idpregunta) as resuelto,
    (select count(*) from voto_pregunta where idpregunta=p.idpregunta and positivo=1) - (select count(*) from voto_pregunta where idpregunta=p.idpregunta and positivo!=1) as votos
    from pregunta as p, usuario as u $where
    order by p.idpregunta desc", $parametros)->fetchAll();
    //aqui annadimos las etiquetas correspondientes a cada una de las preguntas
    $annadirEtiquetas = function($pregunta) {
      $pregunta["etiquetas"] = cargarEtiquetas($pregunta[0]);
      return $pregunta;
    };
    return array_map($annadirEtiquetas, $preguntas);
}

function cargarIndex($pagina) {
  $ultima = ultimaPregunta();
  //esto determina el rango de IDs que cargara la select, que luego se mostraran en pantalla, en funcion de la pagina que queremos
  $rango = [
    "maxima" => ($ultima-($pagina * 10) >= 0 ? $ultima-($pagina * 10) : 0),
    "minima" => ($ultima-(($pagina + 1) * 10)+1) >= 0 ? $ultima-(($pagina + 1) * 10)+1 : 0
  ];
  return busquedaPreguntas("p.idpregunta between :minima and :maxima", $rango);
}

function busquedaPorEtiquetas($etiquetasArray) {
  $parametrosSQL = ":" . implode("|", $etiquetasArray);
  $parametrosSQL = str_replace("|", ", :", $parametrosSQL);

  foreach ($etiquetasArray as $etiqueta) {
    $etiquetas[":$etiqueta"] = $etiqueta;
  }
  return busquedaPreguntas("p.idpregunta in (SELECT idpregunta from pregunta_tiene_etiqueta where idetiqueta in (SELECT idetiqueta from etiqueta where lower(etiqueta) in ($parametrosSQL)))", $etiquetas);
}

function busquedaPorTexto($texto) {
  $where = "";
  $array = [];
  foreach ($texto as $palabra) {
    $where .= " lower(titulo) like :i$palabra or lower(texto) like :i$palabra or";
    $array["i$palabra"] = "%".$palabra."%";
  }
  $where = substr($where, 0, -3);
  return busquedaPreguntas("p.idpregunta in (SELECT idpregunta from pregunta where$where)", $array);
}

//busca e inserta o actualiza el voto de una pregunta
function buscarVoto($base, $dato, $tipoVoto){
    return realizarConsulta("SELECT idusuario FROM $base WHERE idusuario = :usuario and $tipoVoto = :idPreguntaRespuesta;", $dato)->fetch()[0];
}
//no hay necesidad de un return, ya que consultarVotosPregunta realiza una actualización de los votos contra la bbdd
//el motivo de realizar una nueva consulta es por si otro usuario votase antes de que el actual pudiese votar, ya que la página no se recarga por voto de cada usuario
//así obtendría un resultado de votos más exacto.
function insertarVoto($base, $dato, $tipoVoto){
    realizarConsulta("INSERT INTO $base VALUES(:usuario, :idPreguntaRespuesta, :voto) ;", $dato);
}
function actualizarVoto($base, $dato, $tipoVoto){
    realizarConsulta("UPDATE $base SET positivo = :voto WHERE idusuario = :usuario AND $tipoVoto = :idPreguntaRespuesta;", $dato);
}
function consultarVotos($base, $dato, $tipoVoto){
    return realizarConsulta("SELECT SUM(REPLACE(positivo, '0', '-1')) FROM $base WHERE $tipoVoto = :idPreguntaRespuesta;", ["idPreguntaRespuesta"=>$dato])->fetch()[0];
}

function cargarUsuario($id) {
  return realizarConsulta("SELECT *, (select count(*) from pregunta where idusuario=u.idusuario) as preguntas,
    (select count(*) from respuesta where idusuario=u.idusuario) as respuestas,
    (select count(*) from voto_pregunta where idpregunta in (select idpregunta from pregunta where idusuario = :id) and positivo=1) as p_positivos,
    (select count(*) from voto_respuesta where idrespuesta in (select idrespuesta from respuesta where idusuario = :id) and positivo=1) as r_positivos,
    (select count(*) from voto_pregunta where idpregunta in (select idpregunta from pregunta where idusuario = :id) and positivo!=1) as p_negativos,
    (select count(*) from voto_respuesta where idrespuesta in (select idrespuesta from respuesta where idusuario = :id) and positivo=1) as r_negativos
  from usuario as u where idusuario=:id;", ["id" => $id])->fetch();
}

function preguntasDeUsuario($id) {
  return realizarConsulta("SELECT idpregunta, titulo from pregunta where idusuario = :id", ["id" => $id])->fetchAll();
}

function actualizarAvatar($datos) {
  realizarConsulta("UPDATE usuario set url_avatar = :url where idusuario = :id", $datos);
}

function verAvatar($id) {
  return realizarConsulta("SELECT url_avatar from usuario where idusuario = :id", ["id" => $id])->fetch();
}

function actualizarDescripcion($datos) {
  realizarConsulta("UPDATE usuario set descripcion = :descripcion where idusuario = :id", $datos);
}

function etiquetasFrecuentes() {
  return abrirConexion()->query("SELECT etiqueta, (SELECT count(*) from pregunta_tiene_etiqueta where idetiqueta = e.idetiqueta) as frecuencia from etiqueta as e order by frecuencia limit 10")->fetchAll();
}
function preguntaResuelta($idRespuesta, $estado){
  return realizarConsulta("UPDATE respuesta set resuelve = :estado where idrespuesta = :respuesta", ["respuesta"=>$idRespuesta, "estado"=>$estado]);
}
?>
