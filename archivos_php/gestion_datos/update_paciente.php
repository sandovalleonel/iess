<?php


require '../../conexion_base/conexion_base.php';
 

if (isset($_POST['id_paciente'])) {

	$id = $_POST['id_paciente'];
	$historia_clinica = $_POST['historia_clinica_paciente'];
	$nombre = $_POST['nombre_paciente'];
	$apellido = $_POST['apellido_paciente'];
	$edad = $_POST['edad_paciente'];
	$genero = $_POST['genero_paciente'];



	$sql = "UPDATE pacientes 
	SET HIST_CLINICA=$historia_clinica ,NOM_PACIENTE='$nombre'  ,APELLIDO_PACIENTE='$apellido',EDAD=$edad ,GENERO='$genero'
	WHERE ID_PACIENTE=$id";

	$resultado = mysqli_query($conexion, $sql);

	
	if (!$resultado) 
		die("Error Actualizar paciente").mysqli_error($conexion);

	echo "ok";
}
?>