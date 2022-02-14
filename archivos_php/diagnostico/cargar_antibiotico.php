<?php


require '../../conexion_base/conexion_base.php';
 
 
	$sql = "SELECT *
			FROM antibiotico ORDER BY NOMBRE_ANTIBIOTICO";

	$resultado = mysqli_query($conexion ,$sql);

	if (!$resultado) {
		die("Error consultar_antibioticos").mysqli_error($conexion);
	}

	$json = array();

	while($row = mysqli_fetch_array($resultado)){
		$json[] = array(
			'id_antibiotico'=>$row[0],
			'antibiotico' => $row[1]
			
		);
	}

	$jsonstring = json_encode($json);
	echo $jsonstring;
?>