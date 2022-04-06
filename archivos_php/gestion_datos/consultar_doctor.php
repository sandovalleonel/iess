<?php
require '../../conexion_base/conexion_base.php';

$sql = "SELECT ID_PERSONALMEDICO,CED_PERSONAL,CODIGO_AS400,NOM_PERSONAL,APE_PERSONAL,NOMBRE_CARGO FROM `personal_medico`, rol where rol.CARGO = personal_medico.CARGO ";
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