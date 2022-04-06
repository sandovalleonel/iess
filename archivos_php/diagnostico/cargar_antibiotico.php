<?php


require '../../conexion_base/conexion_base.php';
 
 
	$sql = "SELECT *
			FROM antibiotico ORDER BY NOMBRE_ANTIBIOTICO";

	$resultado = mysqli_query($conexion ,$sql);

	if (!$resultado) {
		die("Error consultar_antibioticos").mysqli_error($conexion);
	}

	$combo_antibiotico = "";

	while($row = mysqli_fetch_array($resultado)){
		 
			 
			$combo_antibiotico .= "<option> $row[1] </option>";
			
	
	}

	$combo_opcional = "<option></option>";
	$combo_opcional .= $combo_antibiotico;


?>