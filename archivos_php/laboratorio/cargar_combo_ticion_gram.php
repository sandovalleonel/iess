<?php


 
require '../../conexion_base/conexion_base.php';
 
$sql = "SELECT * FROM estado_tipo_de_reporte ORDER BY ID_ESTADO_TIPO_DE_REPORTE DESC";

$resultado = mysqli_query($conexion ,$sql);

if (!$resultado)
	die("Error consultar_antibioticos").mysqli_error($conexion);

$json = array();

while($row = mysqli_fetch_array($resultado)){
	$json[] = array(
		'id_estado'=>$row[0],
		'estado'=>$row[1] 

	);
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>