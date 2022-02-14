<?php
require '../../conexion_base/conexion_base.php';

$sql = "SELECT * FROM personal_medico";
if (isset($_POST['id'])) {
	$id_busqueda = $_POST['id'];	
	$sql = "SELECT * FROM personal_medico where ID_PERSONALMEDICO=$id_busqueda";
}

$resultado = mysqli_query($conexion , $sql);

if (!$resultado) 
	die("Error query ".mysqli_error($conexion));

$json = array();

while($row = mysqli_fetch_array($resultado)){
	
	$json[] = array(
		'id_medico'=>$row[0],
		'cedula'=>$row[1],
		'codigo'=>$row[2],
		'nombre'=>$row[3],
		'apellido'=>$row[4],
		'cargo'=>$row[5] 
	);
		
}  

$jsonstring = json_encode($json);
echo $jsonstring;
?>