<?php
 
session_start();
$id_med=$_SESSION['id_medico'];
require '../../conexion_base/conexion_base.php';

		$sql = "SELECT 
		(SELECT concat(pa.NOM_PACIENTE,' ',pa.APELLIDO_PACIENTE)FROM pacientes pa WHERE pa.ID_PACIENTE=d.ID_PACIENTE) ,
		(SELECT pa.HIST_CLINICA FROM pacientes pa WHERE pa.ID_PACIENTE=d.ID_PACIENTE) ,
		
		d.ID_DIAGNOSTICO,d.DIAGNOSTICO_COMENTARIO,d.FECHA_DIAGNOSTICO,
		abam.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL, abam.COMENTARIO,
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

		$sql_enfermedades = "SELECT eg.ID_ENFERMEDAD, e.NOM_ENFERMEDAD
							FROM enf_diag eg, enfermedad e
							WHERE eg.ID_ENFERMEDAD = e.ID_ENFERMEDAD AND eg.ID_DIAGNOSTICO = $row[2]";
		$resultado_enfermedades = mysqli_query($conexion ,$sql_enfermedades);
		$enfermedades = array();
		while($row_enfermedades = mysqli_fetch_array($resultado_enfermedades)){ 
			$enfermedades[] = array(
				'id_enfermedad' => $row_enfermedades[0],
				'enfermedad' => $row_enfermedades[1]
			);
		}


		$sql_ant = "SELECT * FROM  antibiotico_individual_completo aic ,antibiotico a 
							WHERE aic.ID_ANTIBIOTICO = a.ID_ANTIBIOTICO AND aic.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL = $row[5]";


		$resultado_ant = mysqli_query($conexion ,$sql_ant);
		$ant = array();
		while($row_ant = mysqli_fetch_array($resultado_ant)){ 
			$ant[] = array(
				'a1' => $row_ant[0],
				'a2' => $row_ant[1],
				'a3' => $row_ant[2],
				'dosis' => $row_ant[3],
				'unidad' => $row_ant[4],
				'via' => $row_ant[5],
				'metodo' => $row_ant[6],
				'inicio' => $row_ant[7],
				'dias' => $row_ant[8],
				'fin' => $row_ant[9],
				'escala' => $row_ant[10],
				'mantiene' => $row_ant[11],
				'descala' => $row_ant[12],
				'ajuste' => $row_ant[13],
				'id_antibiotico' => $row_ant[14],
				'antibiotico_nombre' => $row_ant[15]
			);
		}


		
		

		$json[] = array(
			
			'nombre_paciente' => $row[0],
			'historia_clinica' => $row[1],

			'id_diagnostico'=>$row[2],
			'enfermedades' => $enfermedades,
			'comentario_diagnostico' => $row[3],
			'fecha_diagnostico' => $row[4],


			'id_prescripcion' => $row[5],
			'antibioticos' => $ant,
			'comentario_prescripcion' => $row[6],


			'id_pedido_examen' => $row[7],
			'tipo_examen' => $row[8],
			'fecha_examen' => $row[9]

			
		);

			

	}


	$jsonstring = json_encode($json);
	echo $jsonstring;


?>