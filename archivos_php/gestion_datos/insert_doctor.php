<?php


require '../../conexion_base/conexion_base.php';


 
 
if (isset($_POST['cedula']) && isset($_POST['cargo'])) {

	$cedula = $_POST['cedula'];
	$codigo = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$cargo = $_POST['cargo'];




 	$sql_existe = " SELECT sum(IF (m.CED_PERSONAL=$cedula,1,0))ced, sum(IF (m.CODIGO_AS400=$codigo,1,0))cod
	 					FROM personal_medico m;";
	 $total = mysqli_query($conexion, $sql_existe);
	 $tem_total = mysqli_fetch_array($total);
	 
	 if ($tem_total['ced'] == 1) {
	 	echo "existe_1";
	 	exit();	
	 }
	 if ($tem_total['cod'] == 1) {
		echo "existe_2";
		exit();	
	}



	$id = time()-1636237082;
	$sql = "INSERT INTO personal_medico(ID_PERSONALMEDICO, CED_PERSONAL, CODIGO_AS400, NOM_PERSONAL, APE_PERSONAL, CARGO) 
	VALUES ($id,$cedula,'$codigo','$nombre','$apellido','$cargo')";



	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) {
	 	
		die("Error --ingresar doctor ".mysqli_error($conexion));
	}
 
	echo "ok";
}
 
 ?>