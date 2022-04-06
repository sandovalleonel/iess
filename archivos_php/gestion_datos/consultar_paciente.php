<?php
require '../../conexion_base/conexion_base.php';

$sql = "SELECT * FROM pacientes";

if (isset($_POST['id'])) {
	$id_busqueda = $_POST['id'];	
	$sql = "SELECT * FROM pacientes where ID_PACIENTE=$id_busqueda";
}


$resultado = mysqli_query($conexion , $sql);

if (!$resultado) 
	die("Error query ".mysqli_error($conexion));

$json = array();

while($row = mysqli_fetch_array($resultado)){
	
	$json[] = array(
		'id_paciente'=>$row[0],
		'historia_clinica'=>$row[1],
		'nombre'=>$row[2],
		'apellido'=>$row[3],
		'edad'=>$row[4],
		'genero'=>$row[5] 
	);

} 

$jsonstring = json_encode($json);
echo $jsonstring;
?>