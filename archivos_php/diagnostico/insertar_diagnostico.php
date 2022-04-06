<?php


require '../../conexion_base/conexion_base.php';
 

if (isset($_POST['diagnostico_id_medico'])) {

	date_default_timezone_set('America/Guayaquil');
	$fecha_creacion = date("Y-m-d H:i"); 
	$id_paciente = $_POST['diagnostico_id_paciente'];
	$id_medico = $_POST['diagnostico_id_medico'];
	
	$diagnostico = $_POST['diagnostico_descripcion'];
	$paciente = $_POST['paciente_name'];
	$enfermedades_id = $_POST['enfermedades_id'];
	$enfermedades_name = $_POST['enfermedades_name'];
	$clave_temp = time();

	$enf_name_sesion = "";

	

	$sql="INSERT INTO `diagnostico`(`ID_DIAGNOSTICO`, `ID_PACIENTE`, `ID_PERSONALMEDICO`, `DIAGNOSTICO_COMENTARIO`, `FECHA_DIAGNOSTICO`) VALUES ($clave_temp,$id_paciente, $id_medico, '$diagnostico','$fecha_creacion')";

	

	$resultado = mysqli_query($conexion , $sql);
	//////////////////////////7
	try {
		
		for ($i=0; $i < count($enfermedades_id) ; $i++) { 

			$enf_name_sesion .= $enfermedades_name[$i].", ";
		
			$cod_enf =  $enfermedades_id[$i];
			$id_enf = time()+$i+1;

			$sql_enf = "INSERT INTO `enf_diag`(`id_enf_diag`, `ID_ENFERMEDAD`, `ID_DIAGNOSTICO`) VALUES ($id_enf,$cod_enf,$clave_temp)\n";
			
			$resultado_enf = mysqli_query($conexion , $sql_enf);
			
		}
		
	} catch (Exception $e) {
		echo 'Error guardar Enfermedades: '.$e->getMessage(), "\n";
		exit();
	}
	//////////////////
 
	if (!$resultado) {
		die("error insertar archivo insertar_usuarios_sistema ".mysqli_error($conexion));
	}else{
		
		session_start();
		$_SESSION['ss_paciente'] = $paciente;
		$_SESSION['ss_id_paciente'] =$id_paciente;
		$_SESSION['ss_id_diagnostico'] = $clave_temp;
		$_SESSION['ss_diagnostico'] = $enf_name_sesion;

		echo "ok";
 
	}
	
}

?>