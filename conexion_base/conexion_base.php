<?php

$servidor = "localhost";
$usuario="root";
$contrasenia="";
$db="iess";


$conexion=mysqli_connect($servidor,$usuario,$contrasenia,$db);

$conexion->set_charset("utf8");

/*
if ($conexion) {
	echo "conexion exitosa";
}else {
	echo "Error de conexion";
}*/

?>