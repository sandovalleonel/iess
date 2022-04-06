<?php 


require '../../conexion_base/conexion_base.php';




if (isset($_POST['id_gram'])) {

	date_default_timezone_set('America/Guayaquil');

	$id = time()-1636237082;
	$id_gram=$_POST['id_gram'];
	$id_bacteria=$_POST['id_bacteria'];
	$gen_resistencia=$_POST['gen_resistencia'];
	$fecha=date('Y-m-d');
	$observacion=$_POST['comentario'];


	///validar que no se dupliquen y pueda ingresar varias tecnicas
	 //SELECT count(ID_ANTIBIOGRAMA)
	//FROM tecnicas
	//WHERE ID_GRAM=$id_gram
	 //si es mayor a cero no ingresar

	
	$sql_existe = "SELECT count(ID_ARRAY) total FROM tecnicas WHERE ID_GRAM=$id_gram";
	$total = mysqli_query($conexion, $sql_existe);
	$tem_total = mysqli_fetch_array($total);
	
	if ($tem_total['total'] > 0) {
		echo "existe";
		exit();
	}


	$sql = "INSERT INTO `tecnica_array`(`ID_ARRAY`, `ID_BACTERIA`, `GEN_RESISTENCIA`, `FECHA_ARRAY`, `OBSERVACION_ARRAY`) VALUES ($id,$id_bacteria,'$gen_resistencia','$fecha','$observacion')";
	
	
	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) 
		die("Error ingresar tecnica array").mysqli_error($conexion);





	$sql_validar = "SELECT EXISTS(SELECT * FROM `tecnicas` t WHERE t.ID_GRAM=$id_gram ) existe;";
	$val = mysqli_query($conexion, $sql_validar);
	$tem_val = mysqli_fetch_array($val);

	if ($tem_val['existe'] == 1) {

		$sql_atualizar = "UPDATE `tecnicas` SET `ID_ARRAY`=$id WHERE `ID_GRAM` = $id_gram ";
		$resultado = mysqli_query($conexion, $sql_atualizar);
		if (!$resultado) 
			die("Error Actualizar tecnica bme_t1").mysqli_error($conexion);
		
	}else{


		$id2 = time()-16362382;

		$sql2 = "INSERT INTO `tecnicas`(`ID_TECNICAS`, `ID_GRAM`, `ID_ARRAY`) 
		VALUES ($id2,$id_gram,$id)";

		
		$resultado2 = mysqli_query($conexion, $sql2);

		if (!$resultado2) 
			die("Error ingresar tecnica tecnicas").mysqli_error($conexion);

	}
	echo "ok";
	
}
?>