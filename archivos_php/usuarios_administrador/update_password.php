<?php
require '../../conexion_base/conexion_base.php';
 
if (isset($_POST['id'])) {

	$id = $_POST['id'];
	$clave = $_POST['pass'];
	$clave = md5($clave);

	$sql = "UPDATE usuarios SET PASSWORD = '$clave' where ID_USUARIO=$id";
 
	$result = mysqli_query($conexion,$sql);

	if (!$result) {
		die('Query failed');
	}
	echo "ok";
} 
?>