<?php


require '../../conexion_base/conexion_base.php';
 
if (isset($_POST['historia_clinica'])) {

	$historia_clinica = $_POST['historia_clinica'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$edad = $_POST['edad'];
	$genero = $_POST['genero'];

	$id = time()-1636237082;

	$sql_existe = " SELECT sum(IF (p.HIST_CLINICA=$historia_clinica,1,0))his
					FROM pacientes p;";
	 $total = mysqli_query($conexion, $sql_existe);
	 $tem_total = mysqli_fetch_array($total);
	 
	 if ($tem_total['his'] == 1) {
	 	echo "existe_1";
	 	exit();	
	 }

	$sql = "INSERT INTO pacientes(ID_PACIENTE, HIST_CLINICA, NOM_PACIENTE, APELLIDO_PACIENTE, EDAD, GENERO) VALUES ($id, $historia_clinica,'$nombre' ,'$apellido', '$edad', '$genero')";

	$resultado = mysqli_query($conexion, $sql);

	
	if (!$resultado) 
		die("Error al ingresar").mysqli_error($conexion);

	echo "ok";
}
?>