<?php 


require '../../conexion_base/conexion_base.php';




if (isset($_POST['id_muestra'])) {


	$id = time()-1636237082;
	$id_muestra = $_POST['id_muestra'];
	$fecha = $_POST['g_fecha'];
	$alarma = $_POST['g_alarma'];
	$resultado = $_POST['g_resultado'];
	

	

	$sql = "INSERT INTO `tincion_gram`(`ID_GRAM`, `ID_RECEPCION_MUESTRA_EMOCULTIVO`, `FECHA_GRAM`, `RESULTDO_GRAM`, `ALARMA`) VALUES ($id,$id_muestra,'$fecha','$resultado',$alarma)";



	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) 
		die("Error ingresar gram").mysqli_error($conexion);


	//ingresar gestionar notificacion
	if ($alarma == 1) {
		

		$id2 = time()-100000;
		$sql3 = " INSERT INTO `notificaciones`(`id_notificacion`, `ID_GRAM`, `alarma`, `estado`) VALUES ($id2,$id,$alarma,0)";

		$resultado3 = mysqli_query($conexion, $sql3);

		if (!$resultado3) 
			die("Error ingresar notificacion").mysqli_error($conexion);
	}

	echo "ok";

}
?>