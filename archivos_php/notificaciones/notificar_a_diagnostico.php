<?php 
session_start();	
 if (isset($_SESSION['id_medico'])) {
 
require '../../conexion_base/conexion_base.php';

 $id_doc = $_SESSION['id_medico'];
 
	$sql = "SELECT n.id_notificacion, n.id_paciente,CONCAT(p.NOM_PACIENTE,' ',p.APELLIDO_PACIENTE), id_medico,CONCAT(pm.NOM_PERSONAL,' ',pm.APE_PERSONAL),n.id_diagnostico, n.estado 
FROM notificaciones n, pacientes p,personal_medico pm
WHERE n.id_paciente=p.ID_PACIENTE AND
	  n.id_medico=pm.ID_PERSONALMEDICO AND
      n.alarma=1 AND n.id_medico= $id_doc ORDER BY  n.estado ASC";
 
	$resultado = mysqli_query($conexion ,$sql);

	if (!$resultado) {
		die("Error consultar_antibioticos").mysqli_error($conexion);
	}

	$json = array();

	while($row = mysqli_fetch_array($resultado)){
		$json[] = array(
			'id_notificacion'=>$row[0],
			'id_paciente'=>$row[1],
			'paciente' => $row[2],
			'id_doctor' => $row[3],
			'doctor' => $row[4],
			'id_diagnostico' => $row[5],
			'estado' => $row[6]
			
		);
	}

	$jsonstring = json_encode($json);
	echo $jsonstring;
}
?>