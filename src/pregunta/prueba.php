<?php
echo "sad";
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
buscarVotos();
function buscarVotos(){
    $datoBusqueda = [
        "usuario" => "1",
        "pregunta" => "1"];

    $datoInsertAct = [
        "usuario" => "1",
        "pregunta" => "1",
        "voto" => "1"];
    if(buscarVoto($datoBusqueda) == null){
        return insertarVoto($datoInsertAct);
    }else{
        return actualizarVoto($datoInsertAct);
    }
}

function buscarVoto($dato){
    return realizarConsulta("SELECT idusuario FROM voto_pregunta WHERE idusuario = :usuario and idpregunta = :pregunta;", $dato)->fetch()[0];
}
function insertarVoto($dato){
    //de alguna manera no me permite insertar :base como sustituto al voto_pregunta
    return realizarConsulta("INSERT INTO voto_pregunta VALUES(:usuario, :pregunta, :voto) ;", $dato);
}
function actualizarVoto($dato){
    return realizarConsulta("UPDATE voto_pregunta SET positivo = :voto WHERE idusuario = :usuario AND idpregunta = :pregunta;", $dato);
}

?>
