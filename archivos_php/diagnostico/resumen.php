<?php
 
session_start();
$id_med=$_SESSION['id_medico'];
require '../../conexion_base/conexion_base.php';

		$parametros  = '';
		$parametros = $_POST['paciente_name'];

		$sql = "SELECT 
		concat(pa.NOM_PACIENTE,' ',pa.APELLIDO_PACIENTE),pa.HIST_CLINICA,concat(pm.NOM_PERSONAL,' ',pm.APE_PERSONAL),
		
		d.ID_DIAGNOSTICO,d.DIAGNOSTICO_COMENTARIO,d.FECHA_DIAGNOSTICO,
		abam.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL, abam.COMENTARIO,
		px.ID_PEDIDO_EXAMEN,px.TIPO_EXAMEN,px.FECHA_PEDIDO,
        rme.ID_RECEPCION_MUESTRA_EMOCULTIVO,rme.FECH_MUESTRA,rme.NUME_FRASCOS,
        tg.ID_GRAM,tg.FECHA_GRAM,tg.RESULTDO_GRAM,tg.ALARMA,
        te.ID_TECNICAS,te.FECHA_TECNICAS,

		(SELECT b.NOM_BACTERIA from bacteria b WHERE b.ID_BACTERIA = tarray.ID_BACTERIA),
        tarray.GEN_RESISTENCIA,tarray.OBSERVACION_ARRAY,
        (SELECT b.NOM_BACTERIA from bacteria b WHERE b.ID_BACTERIA = ta.ID_BACTERIA),
        ta.FENOTIPO,ta.REPORTE_ACRODE_A_GUIA,ta.OBSERVACION_ANTIBIOGRAMA,
        (SELECT b.NOM_BACTERIA from bacteria b WHERE b.ID_BACTERIA = teplex.ID_BACTERIA),
        teplex.MEC_RESISTENCIA,teplex.OBSERVACION_EPLEX
		
		FROM
		diagnostico d
        	INNER JOIN pacientes pa ON pa.ID_PACIENTE = d.ID_PACIENTE
            INNER JOIN personal_medico pm ON pm.ID_PERSONALMEDICO=d.ID_PERSONALMEDICO 
		LEFT JOIN antibiotico__basado_en_antibiograma_manual abam ON d.ID_DIAGNOSTICO=abam.ID_DIAGNOSTICO
		LEFT JOIN pedido_examen px ON abam.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL=px.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL
        LEFT JOIN recepcion_muestra_emocultivo rme ON rme.ID_PEDIDO_EXAMEN = px.ID_PEDIDO_EXAMEN
        LEFT JOIN tincion_gram tg ON tg.ID_RECEPCION_MUESTRA_EMOCULTIVO = rme.ID_RECEPCION_MUESTRA_EMOCULTIVO
        LEFT JOIN tecnicas te ON te.ID_GRAM = tg.ID_GRAM
		LEFT JOIN tecnica_array tarray ON tarray.ID_ARRAY = te.ID_ARRAY
		LEFT JOIN tecnica_antibiograma ta ON ta.ID_ANTIBIOGRAMA = te.ID_ANTIBIOGRAMA
		LEFT JOIN tecnica_eplex teplex ON teplex.ID_EPLEX = te.ID_EPLEX


        WHERE  (NOM_PACIENTE LIKE '%$parametros%') OR (APELLIDO_PACIENTE LIKE '%$parametros%')
        ORDER BY d.ID_DIAGNOSTICO DESC, abam.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL ASC
        ";



	$resultado = mysqli_query($conexion ,$sql);
	if (!$resultado) {
		die("Error consultas").mysqli_error($conexion);
	}


	

	$json = array();
	$enfermedades = "";
	$ant = "";

	
	while($row = mysqli_fetch_array($resultado)){

		$sql_enfermedades = "SELECT eg.ID_ENFERMEDAD, e.NOM_ENFERMEDAD
							FROM enf_diag eg, enfermedad e
							WHERE eg.ID_ENFERMEDAD = e.ID_ENFERMEDAD AND eg.ID_DIAGNOSTICO = $row[3] AND ESTADO = 1";
		$resultado_enfermedades = mysqli_query($conexion ,$sql_enfermedades);
		$enfermedades =  array();
	
		while($row_enfermedades = mysqli_fetch_array($resultado_enfermedades)){ 
			$enfermedades[] = array(
				'id_enfermedad' => $row_enfermedades[0],
				'enfermedad' => $row_enfermedades[1]
			);
		}
////////////--------------------------------------------------------------------------

			if($row[6] != null){
					$sql_ant = "SELECT aic.ID_ANTIBIOTICO,a.NOMBRE_ANTIBIOTICO,aic.DOSIS, aic.unidad, aic.via, aic.metodo, aic.INICIO, aic.TIEMPO, aic.FIN, aic.ESCALA, aic.MANTIENE, aic.DESCALA, aic.AJUSTE_DOSIS, aic.EMPIRICO
					 FROM  antibiotico_individual_completo aic ,antibiotico a 
										WHERE aic.ID_ANTIBIOTICO = a.ID_ANTIBIOTICO AND aic.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL = $row[6] AND ESTADO = 1";

					//echo $sql_ant."\n";
					$resultado_ant = mysqli_query($conexion ,$sql_ant);
					$ant = array();
					while($row_ant = mysqli_fetch_array($resultado_ant)){ 
						$ant[] = array(
							'id_antibiotico' => $row_ant[0],
							'antibiotico_nombre' => $row_ant[1],
							'dosis' => $row_ant[2],
							'unidad' => $row_ant[3],
							'via' => $row_ant[4],
							'metodo' => $row_ant[5],
							'inicio' => $row_ant[6],
							'dias' => $row_ant[7],
							'fin' => $row_ant[8],
							'escala' => $row_ant[9],
							'mantiene' => $row_ant[10],
							'descala' => $row_ant[11],
							'ajuste' => $row_ant[12],
							'empirico' => $row_ant[13]
							
						);
					}
				}
////////////--------------------------------------------------------------------------		




//////////////-----------------------------------------------------------------------


		$json[] = array(
			
			'nombre_paciente' => $row[0],
			'historia_clinica' => $row[1],
			'nombre_medico' => $row[2],

			'id_diagnostico'=>$row[3],
			'enfermedades' => $enfermedades,
			'comentario_diagnostico' => $row[4],
			'fecha_diagnostico' => $row[5],


			'id_prescripcion' => $row[6],
			'antibioticos' => $ant,
			'comentario_prescripcion' => $row[7],


			'id_pedido_examen' => $row[8],
			'tipo_examen' => $row[9],
			'fecha_examen' => $row[10],

			'id_muestra'=>$row[11],
			'fecha_muestra'=>$row[12],
			'n_frascos'=>$row[13],

			'id_gram'=>$row[14],
			'fecha_gram'=>$row[15],
			'resultado_gram'=>$row[16],
			'alarma'=>$row[17],

			'id_tecnicas'=>$row[18],
			'fecha_tecnicas'=>$row[19],

			'bacteria_array'=>$row[20],
			'resistecia_array'=>$row[21],
			'observacion_array'=>$row[22],

			'bacteria_antibiograma'=>$row[23],
			'fenotipo_antibiograma'=>$row[24],
			'reporte_antibiograma'=>$row[25],
			'observacion_antibiograma'=>$row[26],

			'bacteria_eplex'=>$row[27],
			'resitencia_eplex'=>$row[28],
			'observacion_eplex'=>$row[29]
		);

			

	}

	$jsonstring = json_encode($json);
	echo $jsonstring;


?>