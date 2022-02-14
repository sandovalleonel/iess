<?php
require '../../conexion_base/conexion_base.php';
if (isset($_POST['id_doctor'])) {


	$id = $_POST['id_doctor'];
	$cedula = $_POST['cedula_doctor'];
	$codigo = $_POST['codigo_doctor'];
	$nombre = $_POST['nombre_doctor'];
	$apellido = $_POST['apellido_doctor'];
	$cargo = $_POST['cargo_doctor'];

	try {
		
	
	$sql = "UPDATE personal_medico SET CED_PERSONAL=$cedula,CODIGO_AS400='$codigo',NOM_PERSONAL='$nombre',APE_PERSONAL='$apellido',CARGO='$cargo' WHERE ID_PERSONALMEDICO=$id";


	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) 
		die("Error Actualizar doctor").mysqli_error($conexion);

	echo "Datos Actualizados";

	} catch (Exception $e) {
		echo "Error!";
	}

}
 
 ?> 