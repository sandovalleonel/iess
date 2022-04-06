 
<?php 
 
 if (isset($_POST['id_notificacion'])) {
 
require '../../conexion_base/conexion_base.php';
 
 	$id = $_POST['id_notificacion'];
	$sql = "UPDATE  notificaciones SET estado=1 WHERE id_notificacion = $id";
	$resultado = mysqli_query($conexion ,$sql);

	if (!$resultado)
		die("Error consultar_resumen").mysqli_error($conexion);
	
	echo "ok";
}
?>