<?php 


require '../../conexion_base/conexion_base.php';




if (isset($_POST['id_gram'])) {



	date_default_timezone_set('America/Guayaquil');

	$id = time()-1636237082;
	$id_gram=$_POST['id_gram'];
	$id_bacteria=$_POST['id_bacteria'];
	$mec_resistencia=$_POST['mec_resistencia'];
	$observacion=$_POST['observacion'];
	$fecha=date('Y-m-d');


	$sql_existe = "SELECT count(ID_EPLEX) total FROM tecnicas WHERE ID_GRAM=$id_gram";
	$total = mysqli_query($conexion, $sql_existe);
	$tem_total = mysqli_fetch_array($total);

	if ($tem_total['total'] > 0) {
		echo "existe";
		exit();
	}

	

	$sql = "INSERT INTO `tecnica_eplex`(`ID_EPLEX`, `ID_BACTERIA`, `MEC_RESISTENCIA`, `FECHA_EPLEX`, `OBSERVACION_EPLEX`)
	VALUES ($id,$id_bacteria,'$mec_resistencia','$fecha','$observacion')";


	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) 
		die("Error ingresar tecnica bme_t1").mysqli_error($conexion);




	//validar si existe, si no ingresar si existe actualizar
	$sql_validar = "SELECT EXISTS(SELECT * FROM `tecnicas` t WHERE t.ID_GRAM=$id_gram ) existe;";
	$val = mysqli_query($conexion, $sql_validar);
	$tem_val = mysqli_fetch_array($val);

	if ($tem_val['existe'] == 1) {

		$sql_atualizar = "UPDATE `tecnicas` SET `ID_EPLEX`=$id WHERE `ID_GRAM` = $id_gram ";
		$resultado = mysqli_query($conexion, $sql_atualizar);
			if (!$resultado) 
				die("Error Actualizar tecnica bme_t1").mysqli_error($conexion);
		
	}else{
		
	


		$id2 = time()-166237082;
		$fecha_tec = date("Y-m-d H:i");
		$sql2="INSERT INTO `tecnicas`(`ID_TECNICAS`, `ID_GRAM`, `ID_EPLEX`,`FECHA_TECNICAS`) 
		VALUES ($id2,$id_gram,$id,'$fecha_tec')";

		$resultado2 = mysqli_query($conexion, $sql2);

		if (!$resultado2) 
			die("Error ingresar tecnica bme_t2").mysqli_error($conexion);

	}

	echo "ok";
	
}
?>