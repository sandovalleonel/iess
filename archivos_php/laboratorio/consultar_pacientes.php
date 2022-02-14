<?php 
 
 
require '../../conexion_base/conexion_base.php';

	$sql = " SELECT px.ID_PEDIDO ,d.ID_DIAGNOSTICO,d.DIAGNOSTICO,pa.ID_PACIENTE,CONCAT(pa.NOM_PACIENTE,'  ',pa.APELLIDO_PACIENTE),m.ID_PERSONALMEDICO,CONCAT(m.NOM_PERSONAL,' ',m.APE_PERSONAL), px.FECHA_PEDIDO,px.id_prescripcion
		FROM diagnostico d, personal_medico m,pacientes pa, pedido_examen px
		WHERE d.ID_PACIENTE = pa.ID_PACIENTE and d.ID_PERSONALMEDICO=m.ID_PERSONALMEDICO and px.ID_DIAGNOSTICO=d.ID_DIAGNOSTICO order by px.FECHA_PEDIDO desc";
$resultado = mysqli_query($conexion , $sql);

if (!$resultado) 
	die("Error query ".mysqli_error($conexion));

$json = array();

while($row = mysqli_fetch_array($resultado)){
	
	$json[] = array(
		'id_pedido_examen'=>$row[0],
		'id_diagnotico'=>$row[1],
		'diagnostico'=>$row[2],
		'id_paciente'=>$row[3],
		'paciente'=>$row[4],
		'id_medico'=>$row[5],
		'medico'=>$row[6],
		'fecha_examen'=>$row[7] ,
		'id_prescripcion'=>$row[8]
	);
		
} 

$jsonstring = json_encode($json);
echo $jsonstring;
?>