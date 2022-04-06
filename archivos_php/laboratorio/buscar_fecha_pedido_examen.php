<?php


 
if (isset($_POST['id'])) {
require '../../conexion_base/conexion_base.php';

 $id = $_POST['id'];
 
	$sql = "SELECT FECHA_PEDIDO FROM pedido_examen WHERE ID_PEDIDO=$id";
	$resultado = mysqli_query($conexion ,$sql);
	if (!$resultado) {
		die("Error consultar_antibioticos").mysqli_error($conexion);
	}

	$fila= mysqli_fetch_array ($resultado);
	echo $fila[0];
	 
 	
	mysqli_close($conexion);
 } 
 ?>