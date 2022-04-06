<?php


require '../../conexion_base/conexion_base.php';

if (isset($_POST['id'])) {
	 

$id = $_POST['id'];

$sql = "SELECT   ID_ANTIBIOTICO, ATB_24_H, INICIO, MEDICO_RESPONSABLE, DOSIS, TIEMPO, ESCALA, MANTIENE, DESCALA, AJUSTE_DOSIS, fin FROM antibiotico__basado_en_antibiograma_manua 
WHERE ID_DIAGNOSTICO = $id
ORDER BY INICIO DESC LIMIT 1";

 
$resultado = mysqli_query($conexion ,$sql);

if (!$resultado)
	die("Error consultar_antibioticos").mysqli_error($conexion);

$json = array();

while($row = mysqli_fetch_array($resultado)){
	$d1=new DateTime($row[2]);
	$d2=new DateTime($row[10]);
	$diff=$d2->diff($d1);
	$dias=$diff->days;
	
 
	$json[] = array(
		'id_antibiotico'=>$row[0],
		'at24'=>$row[1],
		'inicio'=>$row[2],
		'medico'=>$row[3],
		'dosis'=>$row[4],
		'tiempo'=>$row[5],
		'escala'=>$row[6],
		'mantiene'=>$row[7],
		'descala'=>$row[8],
		'ajuste'=>$row[9],
		'fin'=>$row[10],
		'alarma'=>$dias
	);
}

$jsonstring = json_encode($json);
echo $jsonstring;
}
?>