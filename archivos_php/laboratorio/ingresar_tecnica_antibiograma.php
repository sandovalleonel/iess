<?php 
 

require '../../conexion_base/conexion_base.php';
 
if (isset($_POST['id_gram'])) {

	 
date_default_timezone_set('America/Guayaquil');
	
	 $id = time()-1636237082;
	 $id_gram=$_POST['id_gram'];
	 $id_bacteria=$_POST['id_bacteria'];
	 $fenotipo=$_POST['fenotipo'];
	 $fecha=date('Y-m-d');
 	 $reporte_guia=$_POST['reporte_guia'];
 	 $observacion=$_POST['observacion'];		 
	 

 	 $sql_existe = "SELECT count(ID_ANTIBIOGRAMA) total FROM tecnicas WHERE ID_GRAM=$id_gram";
	 $total = mysqli_query($conexion, $sql_existe);
	 $tem_total = mysqli_fetch_array($total);
	 
	 if ($tem_total['total'] > 0) {
	 	echo "existe";
	 	exit();
	 }
	


	$sql = "INSERT INTO `tecnica_antibiograma`(`ID_ANTIBIOGRAMA`, `ID_BACTERIA`, `FENOTIPO`, `FECHA_ANTIBIOGRAMA`, `REPORTE_ACRODE_A_GUIA`, `OBSERVACION_ANTIBIOGRAMA`)
	 VALUES ($id,$id_bacteria,'$fenotipo','$fecha','$reporte_guia','$observacion')";
			 
 	
	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) 
		die("Error ingresar tecnica antibiograma_t1").mysqli_error($conexion);





	$sql_validar = "SELECT EXISTS(SELECT * FROM `tecnicas` t WHERE t.ID_GRAM=$id_gram ) existe;";
	$val = mysqli_query($conexion, $sql_validar);
	$tem_val = mysqli_fetch_array($val);

	if ($tem_val['existe'] == 1) {

		$sql_atualizar = "UPDATE `tecnicas` SET `ID_ANTIBIOGRAMA`=$id WHERE `ID_GRAM` = $id_gram ";
		$resultado = mysqli_query($conexion, $sql_atualizar);
			if (!$resultado) 
				die("Error Actualizar tecnica bme_t1").mysqli_error($conexion);
		
	}else{



	$id2 = time()-1636237082;
	$sql2="INSERT INTO `tecnicas`(`ID_TECNICAS`, `ID_GRAM`, `ID_ANTIBIOGRAMA`) 
	VALUES ($id2,$id_gram,$id)";
	
	$resultado2 = mysqli_query($conexion, $sql2);

	if (!$resultado2) 
		die("Error ingresar tecnica antibiograma_t2").mysqli_error($conexion);


}



	echo "ok";
	
}
?>