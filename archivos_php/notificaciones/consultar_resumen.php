 
<?php 
 
 if (isset($_POST['id_notificacion'])) {
 
require '../../conexion_base/conexion_base.php';
 
 	$id=$_POST['id_notificacion'];
	$sql = "SELECT CONCAT(p.NOM_PACIENTE,' ',p.APELLIDO_PACIENTE), CONCAT(pm.NOM_PERSONAL,' ', pm.APE_PERSONAL), d.DIAGNOSTICO, rme.NOMBRE_RESPONSABLE, rme.RESULTADO
		FROM notificaciones n,pacientes p,personal_medico pm,diagnostico d,recepcion_muestra_emocultivo rme
		WHERE n.id_paciente=p.ID_PACIENTE AND
		  n.id_medico=pm.ID_PERSONALMEDICO AND
	      n.id_diagnostico=d.ID_DIAGNOSTICO AND
	      n.id_recepcion_muestra_emocultivo= rme.ID_RECEPCION_EMOCULTIVO AND
	      n.id_notificacion=$id";
 
	$resultado = mysqli_query($conexion ,$sql);

	if (!$resultado) {
		die("Error consultar_resumen").mysqli_error($conexion);
	}
 
	while($row = mysqli_fetch_array($resultado)){
		 echo "
Paciente: $row[0]
Médico: $row[1]
Mi diagnóstico: $row[2]
Médico de laboratorio: $row[3]
Resultado  de laboratorio: $row[4]
		 ";
	}
 
}
?>