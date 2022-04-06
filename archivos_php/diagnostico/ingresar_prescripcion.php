<?php


require '../../conexion_base/conexion_base.php';
 

if (isset($_POST['id_diag'])) {




 date_default_timezone_set('America/Guayaquil');
	
	$clave_temp = time()-1000000;
	$id_diagnostico = $_POST['id_diag'];

	$antibiotico_1 = $_POST['antibiotico_1'];
	$antibiotico_2 = $_POST['antibiotico_2'];
	$antibiotico_3 = $_POST['antibiotico_3'];

	$dosis_1 = $_POST['dosis_1'];
	$dosis_2 = $_POST['dosis_2'];
	$dosis_3 = $_POST['dosis_3'];
	
	$inicio = date('Y-m-d');
	$tiempo = $_POST['tiempo'];
	$fecha_fin = date("Y-m-d",strtotime($inicio."+ $tiempo days"));

	
	$escala = $_POST['escala'];
	$mantiene =  $_POST['mantiene'];
	$descala = $_POST['descala'];
	$ajuste_dosis = $_POST['ajuste_dosis'];
	

	 

	$sql = "INSERT INTO `antibiotico__basado_en_antibiograma_manual`(`ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL`, `ID_DIAGNOSTICO`, `ANTIBIOTICO_1`, `DOSIS_1`, `ANTIBIOTICO_2`, `DOSIS_2`, `ANTIBIOTICO_3`, `DOSIS_3`, `INICIO`, `TIEMPO`, `FIN`, `ESCALA`, `MANTIENE`, `DESCALA`, `AJUSTE_DOSIS`) 
			VALUES ($clave_temp,$id_diagnostico,'$antibiotico_1','$dosis_1','$antibiotico_2','$dosis_2','$antibiotico_3','$dosis_3 ','$inicio',$tiempo,'$fecha_fin','$escala','$mantiene','$descala','$ajuste_dosis' )";
 
  	 

	$resultado = mysqli_query($conexion , $sql);
	 
	if (!$resultado) {
		die("error insertar archivo insertar_usuarios_sistema ".mysqli_error($conexion));
	}else{
		session_start();
		if (isset($_SESSION['ss_id_paciente'])) {
			
			unset($_SESSION['ss_id_paciente']);
			unset($_SESSION['ss_paciente']);}

		if (isset($_SESSION['ss_id_diagnostico'])) {
		  
			unset($_SESSION['ss_id_diagnostico']);
			unset($_SESSION['ss_diagnostico']);}

 
		echo "ok";
	 
		
	}
	
}

?>