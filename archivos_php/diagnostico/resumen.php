<?php

session_start();
$id_med=$_SESSION['id_medico'];
require '../../conexion_base/conexion_base.php';

		$sql = "SELECT (SELECT concat(pa.NOM_PACIENTE,' ',pa.APELLIDO_PACIENTE) FROM pacientes pa WHERE pa.ID_PACIENTE=d.ID_PACIENTE) ,
d.ID_DIAGNOSTICO,d.ID_DIAGNOSTICO,
( SELECT GROUP_CONCAT(enfermedad.NOM_ENFERMEDAD) from enf_diag, enfermedad WHERE  enf_diag.ID_DIAGNOSTICO=d.ID_DIAGNOSTICO AND enfermedad.ID_ENFERMEDAD=enf_diag.ID_ENFERMEDAD GROUP by enf_diag.ID_DIAGNOSTICO)
,
d.DIAGNOSTICO_COMENTARIO,d.FECHA_DIAGNOSTICO,
abam.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL, abam.ANTIBIOTICO_1, abam.DOSIS_1, abam.ANTIBIOTICO_2, abam.DOSIS_2,abam.ANTIBIOTICO_3,abam.DOSIS_3, abam.INICIO,abam.TIEMPO,abam.FIN,abam.ESCALA,abam.MANTIENE,abam.DESCALA,abam.AJUSTE_DOSIS,
px.ID_PEDIDO_EXAMEN,px.TIPO_EXAMEN,px.FECHA_PEDIDO
		
		FROM
		diagnostico d
		LEFT JOIN antibiotico__basado_en_antibiograma_manual abam ON d.ID_DIAGNOSTICO=abam.ID_DIAGNOSTICO
		LEFT JOIN pedido_examen px ON abam.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL=px.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL
        WHERE d.ID_PERSONALMEDICO =  $id_med

        ORDER BY d.ID_DIAGNOSTICO DESC, abam.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL DESC
        LIMIT 100
        ";




	$resultado = mysqli_query($conexion ,$sql);
	if (!$resultado) {
		die("Error consultas").mysqli_error($conexion);
	}
	$json = array();
	while($row = mysqli_fetch_array($resultado)){
 
		$json[] = array(
			
			'nombre_paciente' => $row[0],
			'id_diagnostico'=>$row[1],
			'enfermedad_1' => $row[2],
			'enfermedad_2'=>$row[3],
			'comentario' => $row[4],
			'fecha_diagnostico' => $row[5],


			'id_prescripcion' => $row[6],
			'antibiotico_1' => $row[7],
			'dosis_1' => $row[8],
			'antibiotico_2' => $row[9],
			'dosis_2' => $row[10],
			'antibiotico_3' => $row[11],
			'dosis_3' => $row[12],
			'inicio' => $row[13],
			'tiempo' => $row[14],
			'fin' => $row[15],
			'escala' => $row[16],
			'mantiene' => $row[17],
			'descala' => $row[18],
			'ajuste_dosis' => $row[19],


			'id_pedido_examen' => $row[20],
			'tipo_examen' => $row[21],
			'fecha_examen' => $row[22]



			
		);
			

	}


	$jsonstring = json_encode($json);
	echo $jsonstring;


?>