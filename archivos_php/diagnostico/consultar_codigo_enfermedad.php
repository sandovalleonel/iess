<?php


require '../../conexion_base/conexion_base.php';


$sql = "SELECT COD_ENFERMEDAD FROM enfermedad GROUP BY COD_ENFERMEDAD";

$resultado = mysqli_query($conexion ,$sql);

if (!$resultado)
	die("Error consultar_antibioticos").mysqli_error($conexion);

$json = array();

while($row = mysqli_fetch_array($resultado)){
	$json[] = array(
		'cod_enfermedad'=>$row[0]

	);
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>