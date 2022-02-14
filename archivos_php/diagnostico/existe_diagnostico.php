<?php


require '../../conexion_base/conexion_base.php';

if (isset($_POST['id'])) {
	 

$id = $_POST['id'];

$sql = "SELECT ID_DIAGNOSTICO ,DIAGNOSTICO 
FROM diagnostico
WHERE ID_PACIENTE= $id
ORDER by FECHA_DIAGNOSTICO DESC LIMIT 1";

$resultado = mysqli_query($conexion ,$sql);

if (!$resultado)
	die("Error consultar_antibioticos").mysqli_error($conexion);

$json = array();

while($row = mysqli_fetch_array($resultado)){
	$json[] = array(
		'id_diagnotico'=>$row[0],
		'diagnostico'=>$row[1]
	);
}

$jsonstring = json_encode($json);
echo $jsonstring;
}
?>