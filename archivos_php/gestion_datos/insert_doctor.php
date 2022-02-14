<?php


require '../../conexion_base/conexion_base.php';


 
 
if (isset($_POST['cedula'])) {

	$cedula = $_POST['cedula'];
	$codigo = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$cargo = $_POST['cargo'];

	$id = time()-1636237082;
	$sql = "INSERT INTO personal_medico(ID_PERSONALMEDICO, CED_PERSONAL, CODIGO_AS400, NOM_PERSONAL, APE_PERSONAL, CARGO) VALUES ($id,$cedula,$codigo,'$nombre','$apellido','$cargo')";

	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) 
		die("Error ingresar doctor").mysqli_error($conexion);

	echo "ok";
}
 
 ?>