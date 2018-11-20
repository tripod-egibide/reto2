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
  //devuelve la mayor ID de pregunta, que como es autoincremental siempre sera la mas reciente
  //ojo, que es en forma de string
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

function ultimaRespuesta(){
    //devuelve la mayor ID de pregunta, que como es autoincremental siempre sera la mas reciente
    //ojo, que es en forma de string
    return abrirConexion()->query("SELECT max(idrespuesta) from respuesta")->fetch()[0];
}

function insertarPregunta($datos){
    //obtiene el último registro
    $r = ultimaPregunta();
    //inserta registro
  if(realizarConsulta("INSERT INTO pregunta VALUES (NULL, :usuario, :titulo, :mensaje, DEFAULT);", $datos) == null){
    //si no devuelve nada, es que ha fallado
      return null;
      //compara si se ha introducido
  }else if(ultimaPregunta()> $r){
      // si introducido ok, en caso contrario null
      return "ok";
  }
  else{
      return null;
  }
}

function insertarEtiqueta($etiquetas, $idPregunta){
    $cont = false;
    foreach($etiquetas as $etiqueta){
        $etiqueta = mb_convert_case($etiqueta, MB_CASE_TITLE, "UTF-8");
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
    var_dump($datos);
    echo "lol" ;
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
  return realizarConsulta("SELECT idetiqueta FROM ETIQUETA WHERE etiqueta = :etiqueta;", ["etiqueta" => $etiqueta])->fetch()[0];
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
      (SELECT count(*) from voto_respuesta where idrespuesta=:id and positivo=1) as positivos,
      (SELECT count(*) from voto_respuesta where idrespuesta=:id and positivo!=1) as negativos
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
    "maxima" => $ultima-($pagina * 10) >= 0 ? $ultima-($pagina * 10) : 0,
    "minima" => ($ultima-(($pagina + 1) * 10)+1) >= 0 ? $ultima-(($pagina + 1) * 10)+1 : 0
  ];

  return busquedaPreguntas("p.idpregunta between :minima and :maxima", $rango);
}

function busquedaPorEtiquetas($etiquetasArray) {
  $parametrosSQL = ":" . implode("|", $etiquetasArray);
  $parametrosSQL = str_replace("|", ", :", $parametrosSQL);

  foreach ($etiquetasArray as $id) {
    $etiquetas[":$id"] = $id;
  }
  return busquedaPreguntas("p.idpregunta in (SELECT idpregunta from pregunta_tiene_etiqueta where idetiqueta in ($parametrosSQL))", $etiquetas);
}

function busquedaPorTexto($texto) {
  // TODO: preguntar a jon si esto se deberia mejorar
  // concretamente sobre las posibles busquedas repetidas y las palabras basura
  //p.idpregunta in (SELECT idpregunta from pregunta where titulo like '%:t%' or texto like '%:t%')
  return busquedaPreguntas("p.idpregunta in (SELECT idpregunta from pregunta where lower(titulo) like :t or lower(texto) like :t)", ["t" => strtolower("%".$texto."%")]);
}

function buscarVoto($base, $usuario, $pregunta){
    return realizarConsulta("SELECT positivo FROM :base WHERE idusuario = :usuario and idpregunta = :pregunta;", ["base"=>$base,"usuario"=>$usuario, "pregunta"=>$pregunta])->fetch()[0];

}
function insertarVoto($dato){
    //de alguna manera no me permite insertar :base como sustituto al voto_pregunta
    return realizarConsulta("INSERT INTO voto_pregunta VALUES(:usuario, :pregunta, :valor) ;", $dato);
}
function actualizarVoto($dato){
    return realizarConsulta("INSERT INTO voto_pregunta VALUES(1, 1, 1) ;", $dato);
    //return realizarConsulta("UPDATE voto_pregunta SET positivo = :valor WHERE idusuario = :usuario and idpregunta = :pregunta ;", $dato);
}
?>
