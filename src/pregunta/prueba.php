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
buscarVoto();
function buscarVoto(){
    echo realizarConsulta("SELECT positivo FROM voto_pregunta WHERE idusuario = :usuario and idpregunta = :pregunta;", ["usuario"=>"1", "pregunta"=>"1"])->fetch()[0];
}

?>
