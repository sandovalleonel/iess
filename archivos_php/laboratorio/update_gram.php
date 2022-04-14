<?php 


require '../../conexion_base/conexion_base.php';




if (isset($_POST['id_tincion'])) {



	$id = $_POST['id_tincion'];
	$alarma = $_POST['g_alarma'];
	$resultado = $_POST['g_resultado'];
	

	
	//eliminar y luego ingresar
	$sql = "UPDATE `tincion_gram` SET `RESULTDO_GRAM`='$resultado',`ALARMA`='$alarma' WHERE ID_GRAM = $id";



	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) 
		die("Error ingresar gram").mysqli_error($conexion);


	//ingresar gestionar notificacion

		
		$sql_eliminar = "DELETE FROM `notificaciones` WHERE `ID_GRAM` = $id";
		mysqli_query($conexion, $sql_eliminar);
				//update
		$id_not = time()+5;
		$sql3 = "INSERT INTO `notificaciones`(`id_notificacion`, `ID_GRAM`, `alarma`, `estado`) VALUES ($id_not,$id,$alarma,0)";

		$resultado3 = mysqli_query($conexion, $sql3);

		if (!$resultado3) 
			die("Error Actualizar notificacion").mysqli_error($conexion);


	echo "ok";

}
?>