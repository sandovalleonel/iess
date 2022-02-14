<?php
require '../../conexion_base/conexion_base.php';

$sql = "SELECT ID_USUARIO, CONCAT(p.NOM_PERSONAL,' ',p.APE_PERSONAL),u.USUARIO,p.CARGO FROM usuarios u ,personal_medico p WHERE p.ID_PERSONALMEDICO = u.ID_PERSONALMEDICO";
$resultado = mysqli_query($conexion , $sql);

if (!$resultado) 
	die("Error query ".mysqli_error($conexion));

$json = array();

while($row = mysqli_fetch_array($resultado)){
	
	$json[] = array(
		'id'=>$row[0],
		'nombre'=>$row[1],
		'usuario'=>$row[2],
		'cargo'=>$row[3]
	);
		
} 

$jsonstring = json_encode($json);
echo $jsonstring;
?>