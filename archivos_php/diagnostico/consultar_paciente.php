<?php


require '../../conexion_base/conexion_base.php';
 
if (isset($_POST['apellido_paciente'])) {

	$apellido = $_POST['apellido_paciente'];
	$sql = "SELECT p.ID_PACIENTE, CONCAT(p.APELLIDO_PACIENTE,' ',p.NOM_PACIENTE) 
			FROM pacientes p
			WHERE p.APELLIDO_PACIENTE LIKE '%$apellido%'";

	$resultado = mysqli_query($conexion ,$sql);

	if (!$resultado) {
		die("Error consultar_paciente").mysqli_error($conexion);
	}

	$json = array();

	while($row = mysqli_fetch_array($resultado)){
		$json[] = array(
			'id_paciente'=>$row[0],
			'nombre' => $row[1]
			
		);
	}

	$jsonstring = json_encode($json);
	echo $jsonstring;
}
?>