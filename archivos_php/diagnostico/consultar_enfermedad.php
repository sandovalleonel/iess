<?php


if (!isset($_POST['cod'])) {
	die();
}
require '../../conexion_base/conexion_base.php';

$codigo = $_POST['cod'];
$sql = "SELECT ID_ENFERMEDAD, COD_ENFERMEDAD, NOM_ENFERMEDAD FROM enfermedad WHERE COD_ENFERMEDAD='$codigo'";

$resultado = mysqli_query($conexion ,$sql);

if (!$resultado)
	die("Error consultar_antibioticos").mysqli_error($conexion);

$json = array();

while($row = mysqli_fetch_array($resultado)){
	$json[] = array(
		'id_enfermedad'=>$row[0],
		'cod_enfermedad'=>$row[1],
		'enfermedad'=>$row[2]

	);
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>