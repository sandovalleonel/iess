<?php


require '../../conexion_base/conexion_base.php';
 

if (isset($_POST['diagnostico_id_medico'])) {

	date_default_timezone_set('America/Guayaquil');
	$fecha_creacion = date("Y-m-d H:i "); 
	$id_paciente = $_POST['diagnostico_id_paciente'];
	$id_medico = $_POST['diagnostico_id_medico'];
	$id_enfermedad = $_POST['diagnostico_enfermedad'];
	$id_enfermedad_2 = $_POST['diagnostico_enfermedad_2'];
	$diagnostico = $_POST['diagnostico_descripcion'];
	$notificacion = "";
	$clve_temp = time();

	$paciente = $_POST['paciente_name'];


	$sql = "INSERT INTO diagnostico(ID_DIAGNOSTICO,ID_PACIENTE, ID_PERSONALMEDICO, ID_ENFERMEDAD,ID_ENFERMEDAD_2, DIAGNOSTICO, FECHA_DIAGNOSTICO, NOTIFICACION) VALUES ($clve_temp,$id_paciente, $id_medico, $id_enfermedad,$id_enfermedad_2,'$diagnostico','$fecha_creacion','$notificacion')";


	$resultado = mysqli_query($conexion , $sql);
	if (!$resultado) {
		die("error insertar archivo insertar_usuarios_sistema ".mysqli_error($conexion));
	}else{
		
		session_start();
		$_SESSION['ss_paciente'] = $paciente;
		$_SESSION['ss_id_paciente'] =$id_paciente;
		$_SESSION['ss_id_diagnostico'] = $clve_temp;
		$_SESSION['ss_diagnostico'] = $_POST['desc_diag'];

		echo "ok";
 
	}
	
}

?>