 
<?php 
 
 if (isset($_POST['id_notificacion'])) {
 
require '../../conexion_base/conexion_base.php';
 
 	$id=$_POST['id_notificacion'];
	$sql = "
SELECT concat(p.NOM_PACIENTE ,' ', p.APELLIDO_PACIENTE), px.ID_PEDIDO_EXAMEN, rme.NOMBRE_RESPONSABLE,rme.FECH_MUESTRA,rme.NUME_FRASCOS,rme.RESULTADO, tg.FECHA_GRAM, tg.RESULTDO_GRAM,n.id_notificacion, n.estado
FROM 
pacientes p, diagnostico d, antibiotico__basado_en_antibiograma_manual abam, pedido_examen px, recepcion_muestra_emocultivo rme, tincion_gram tg ,notificaciones n
WHERE 
d.ID_PACIENTE = p.ID_PACIENTE AND
d.ID_DIAGNOSTICO = abam.ID_DIAGNOSTICO AND
abam.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL = px.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL AND
px.ID_PEDIDO_EXAMEN = rme.ID_PEDIDO_EXAMEN AND
rme.ID_RECEPCION_MUESTRA_EMOCULTIVO = tg.ID_RECEPCION_MUESTRA_EMOCULTIVO AND
tg.ID_GRAM = n.ID_GRAM AND
n.id_notificacion =  $id ORDER BY  n.estado ASC";



 
	$resultado = mysqli_query($conexion ,$sql);

	if (!$resultado) {
		die("Error consultar_resumen").mysqli_error($conexion);
	}
 
	while($row = mysqli_fetch_array($resultado)){
		 echo "
		 Datos Informatívos
Paciente: $row[0]
Cod_Examen: $row[1]
Médico de laboratorio: $row[2]

		 Información muestra
Fecha: $row[3]
Número frascos: $row[4]
Resultado: $row[5]

		  Información Gram
Fecha: $row[6]
Resultado: $row[7]
		 ";
	}
 
}
?>