<?php
require '../../conexion_base/conexion_base.php';
 

if (isset($_POST['id'])) {
	$id = $_POST['id'];
	echo "$id";
	$sql = "delete from usuarios where ID_USUARIO=$id";
 
	$result = mysqli_query($conexion,$sql);
	echo $sql;
	if (!$result) {
		die('Query failed');
	}
	echo "Tarea eliminada con exito";
} 
?>