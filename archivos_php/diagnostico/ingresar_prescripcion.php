<?php


require '../../conexion_base/conexion_base.php';
 

if (isset($_POST['id_diag'])) {




 date_default_timezone_set('America/Guayaquil');
	
	$clave_temp = time()-1000000;
	$id_diagnostico = $_POST['id_diag'];
	$id_antibiograma_basado = 5;
	$id_antibiotico = $_POST['id_antibiotico'];
	$atb24 = $_POST['at24'];
	$inicio = date('Y-m-d');
	$medico = $_POST['medico_responsable'];
	$dosis = $_POST['dosis'];
	$tiempo = $_POST['tiempo'];
	$escala = $_POST['escala'];
	$mantiene =  $_POST['mantiene'];
	$descala = $_POST['descala'];
	$ajuste_dosis = $_POST['ajuste_dosis'];
	$fecha_fin = date("Y-m-d",strtotime($inicio."+ $tiempo days"));

	 

	$sql = "INSERT INTO antibiotico__basado_en_antibiograma_manua(ID_ANTIBIOTICO__BASADO_EN_ANTIBIOGRAMA_MANUAL__, ID_DIAGNOSTICO, ID_ESTADO_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA, ID_ANTIBIOTICO, ATB_24_H, INICIO, MEDICO_RESPONSABLE, DOSIS, TIEMPO, ESCALA, MANTIENE, DESCALA, AJUSTE_DOSIS,fin) 
		VALUES ($clave_temp,$id_diagnostico, $id_antibiograma_basado, $id_antibiotico, '$atb24' ,'$inicio','$medico','$dosis','$tiempo','$escala','$mantiene','$descala','$ajuste_dosis','$fecha_fin')";
 
	$resultado = mysqli_query($conexion , $sql);
	//echo $sql;
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