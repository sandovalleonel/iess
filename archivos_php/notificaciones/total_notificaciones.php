<?php 
session_start();
 if (isset($_SESSION['id_medico'])) {
 
require '../../conexion_base/conexion_base.php';

 $id_doc = $_SESSION['id_medico'];
 
	$sql = "SELECT COUNT(*)
FROM 
diagnostico d, antibiotico__basado_en_antibiograma_manual abam, pedido_examen px, recepcion_muestra_emocultivo rme, tincion_gram tg ,notificaciones n
WHERE 
d.ID_DIAGNOSTICO = abam.ID_DIAGNOSTICO AND
abam.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL = px.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL AND
px.ID_PEDIDO_EXAMEN = rme.ID_PEDIDO_EXAMEN AND
rme.ID_RECEPCION_MUESTRA_EMOCULTIVO = tg.ID_RECEPCION_MUESTRA_EMOCULTIVO AND
tg.ID_GRAM = n.ID_GRAM AND
n.alarma = 1 AND n.estado = 0 AND
d.ID_PERSONALMEDICO =  $id_doc 
";
 
	$resultado = mysqli_query($conexion ,$sql);

	if (!$resultado) {
		die("Error consultar_antibioticos").mysqli_error($conexion);
	}

	$fila= mysqli_fetch_array ($resultado);
	echo $fila[0];
	 
 	
	mysqli_close($conexion);
}
?>