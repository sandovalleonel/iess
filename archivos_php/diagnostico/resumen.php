<?php


require '../../conexion_base/conexion_base.php';
 
	//es una vista
	/*$sql__ = "SELECT di.ID_DIAGNOSTICO, di.ID_PACIENTE, di.ID_ENFERMEDAD, di.ID_ENFERMEDAD_2, di.DIAGNOSTICO, di.FECHA_DIAGNOSTICO,
		pr.ID_ANTIBIOTICO__BASADO_EN_ANTIBIOGRAMA_MANUAL__, pr.ID_ANTIBIOTICO, pr.INICIO, pr.DOSIS, pr.ESCALA, pr.MANTIENE,  pr.DESCALA,pr.AJUSTE_DOSIS ,pr.fin,
        pe.ID_TIPO_EXAMEN,pe.FECHA_PEDIDO
		FROM
		diagnostico di
		LEFT JOIN
		antibiotico__basado_en_antibiograma_manua pr on di.ID_DIAGNOSTICO=pr.ID_DIAGNOSTICO 
		LEFT JOIN 
		pedido_examen pe ON di.ID_DIAGNOSTICO=pe.ID_DIAGNOSTICO

		ORDER BY di.ID_DIAGNOSTICO DESC"*/;
		$sql ="
		SELECT 
		vdi.ID_DIAGNOSTICO, vdi.ID_PACIENTE, vdi.nom_paciente, vdi.ID_PERSONALMEDICO, vdi.nom_medico, vdi.ID_ENFERMEDAD, vdi.NOM_ENFERMEDAD, vdi.ID_ENFERMEDAD_2, vdi.nom_enfermedad_2, vdi.DIAGNOSTICO, vdi.FECHA_DIAGNOSTICO ,pr.ID_ANTIBIOTICO,pr.NOMBRE_ANTIBIOTICO, pr.INICIO,pr.DOSIS,pr.TIEMPO,pr.ESCALA,pr.MANTIENE,pr.DESCALA,pr.AJUSTE_DOSIS,pr.fin,
		pe.TIPO_DE_EXAMEN,pe.FECHA_PEDIDO,
		pr.ID_ANTIBIOTICO__BASADO_EN_ANTIBIOGRAMA_MANUAL__
		FROM v_diagnostico_2 vdi
		LEFT JOIN
		v_prescripcion pr on vdi.ID_DIAGNOSTICO=pr.ID_DIAGNOSTICO
		LEFT JOIN 
		v_ped_examen pe ON vdi.ID_DIAGNOSTICO=pe.ID_DIAGNOSTICO 

		 and pe.id_prescripcion =pr.ID_ANTIBIOTICO__BASADO_EN_ANTIBIOGRAMA_MANUAL__

		ORDER by vdi.ID_DIAGNOSTICO DESC, pr.ID_ANTIBIOTICO__BASADO_EN_ANTIBIOGRAMA_MANUAL__ DESC;
		";


	$resultado = mysqli_query($conexion ,$sql);
	if (!$resultado) {
		die("Error consultas").mysqli_error($conexion);
	}
	$json = array();
	while($row = mysqli_fetch_array($resultado)){

		$json[] = array(
			
			'id_diagnostico' => $row[0],
			'id_paciente'=>$row[1],
			'nombre_paciente' => $row[2],
			'id_medico'=>$row[3],
			'nombre_medico' => $row[4],
			'id_enfermedad1' => $row[5],
			'nombre_enfermedad1' => $row[6],
			'id_enfermedad2' => $row[7],
			'nombre_enfermedad2' => $row[8],
			'diagnostico' => $row[9],
			'fecha_diagnostico' => $row[10],
			'id_antibiotico' => $row[11],
			'antibiotico' => $row[12],
			'inicio' => $row[13],
			'dosis' => $row[14],
			'tiempo' => $row[15],
			'escala' => $row[16],
			'mantiene' => $row[17],
			'desescala' => $row[18],
			'ajuste_dosis' => $row[19],
			'fin' => $row[20],
			'tipo_examen' => $row[21],
			'fecha_pedido' => $row[22],
			'id_prescripcion' => $row[23]



			
		);
			

	}

	$jsonstring = json_encode($json);
	echo $jsonstring;


?>