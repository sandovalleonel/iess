<?php 
session_start();
 if (isset($_SESSION['id_medico'])) {
 
require '../../conexion_base/conexion_base.php';

 $id_doc = $_SESSION['id_medico'];
 
	$sql = "SELECT COUNT(estado) FROM notificaciones WHERE id_medico=$id_doc AND alarma=1 AND estado=0";
 
	$resultado = mysqli_query($conexion ,$sql);

	if (!$resultado) {
		die("Error consultar_antibioticos").mysqli_error($conexion);
	}

	$fila= mysqli_fetch_array ($resultado);
	echo $fila[0];
	 
 	
	mysqli_close($conexion);
}
?>