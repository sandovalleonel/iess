<?php


require '../../conexion_base/conexion_base.php';
 
 
	$sql = "SELECT * FROM estado_antibiotico_basado_en_antibiograma";

	$resultado = mysqli_query($conexion ,$sql);

	if (!$resultado) {
		die("Error consultar_antibioticos").mysqli_error($conexion);
	}

	$json = array();

	while($row = mysqli_fetch_array($resultado)){
		$json[] = array(
			'id_antibiograma'=>$row[0],
			'antibiograma' => $row[1]
			
		);
	}

	$jsonstring = json_encode($json);
	echo $jsonstring;
?>