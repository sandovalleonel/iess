<?php 
session_start();	
 if (isset($_SESSION['id_medico'])) {
 
require '../../conexion_base/conexion_base.php';

 $id_doc = $_SESSION['id_medico'];
 
	$sql = "

SELECT concat(p.NOM_PACIENTE ,' ', p.APELLIDO_PACIENTE), px.ID_PEDIDO_EXAMEN, n.id_notificacion, n.estado
FROM 
pacientes p, diagnostico d, antibiotico__basado_en_antibiograma_manual abam, pedido_examen px, recepcion_muestra_emocultivo rme, tincion_gram tg ,notificaciones n
WHERE 
d.ID_PACIENTE = p.ID_PACIENTE AND
d.ID_DIAGNOSTICO = abam.ID_DIAGNOSTICO AND
abam.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL = px.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL AND
px.ID_PEDIDO_EXAMEN = rme.ID_PEDIDO_EXAMEN AND
rme.ID_RECEPCION_MUESTRA_EMOCULTIVO = tg.ID_RECEPCION_MUESTRA_EMOCULTIVO AND
tg.ID_GRAM = n.ID_GRAM AND
d.ID_PERSONALMEDICO =  $id_doc ORDER BY  n.estado ASC";
 
	$resultado = mysqli_query($conexion ,$sql);

	if (!$resultado) {
		die("Error consultar_antibioticos").mysqli_error($conexion);
	}

	$json = array();

	while($row = mysqli_fetch_array($resultado)){
		$json[] = array(
			'paciente'=>$row[0],
			'cod_examen'=>$row[1],
			'id_notificacion'=>$row[2],
			'estado'=>$row[3]			
		);
	}

	$jsonstring = json_encode($json);
	echo $jsonstring;
}
?>