<?php


require '../../conexion_base/conexion_base.php';


$sql ="
		SELECT (SELECT concat(pa.NOM_PACIENTE,' ',pa.APELLIDO_PACIENTE)  FROM pacientes pa WHERE pa.ID_PACIENTE=d.ID_PACIENTE) pacientes ,
	   (SELECT concat(pm.NOM_PERSONAL,' ',pm.APE_PERSONAL)  FROM personal_medico pm WHERE pm.ID_PERSONALMEDICO = d.ID_PERSONALMEDICO) medicos,
d.ID_DIAGNOSTICO, 
d.ID_DIAGNOSTICO,
( SELECT GROUP_CONCAT(enfermedad.NOM_ENFERMEDAD) from enf_diag, enfermedad WHERE  enf_diag.ID_DIAGNOSTICO=d.ID_DIAGNOSTICO AND enfermedad.ID_ENFERMEDAD=enf_diag.ID_ENFERMEDAD GROUP by enf_diag.ID_DIAGNOSTICO)
,



d.DIAGNOSTICO_COMENTARIO,d.FECHA_DIAGNOSTICO,
abam.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL, abam.ANTIBIOTICO_1, abam.DOSIS_1, abam.ANTIBIOTICO_2, abam.DOSIS_2,abam.ANTIBIOTICO_3,abam.DOSIS_3, abam.INICIO,abam.TIEMPO,abam.FIN,abam.ESCALA,abam.MANTIENE,abam.DESCALA,abam.AJUSTE_DOSIS,
px.ID_PEDIDO_EXAMEN,px.TIPO_EXAMEN,px.FECHA_PEDIDO,
rme.ID_RECEPCION_MUESTRA_EMOCULTIVO,rme.NOMBRE_RESPONSABLE,rme.FECH_MUESTRA,rme.NUME_FRASCOS,rme.RESULTADO,
tg.ID_GRAM,tg.FECHA_GRAM,tg.RESULTDO_GRAM,tg.ALARMA,
      
t.ID_TECNICAS,

(SELECT b.NOM_BACTERIA from bacteria b WHERE b.ID_BACTERIA = tarray.ID_BACTERIA),
tarray.ID_ARRAY,tarray.GEN_RESISTENCIA,tarray.FECHA_ARRAY,tarray.OBSERVACION_ARRAY,
(SELECT b.NOM_BACTERIA from bacteria b WHERE b.ID_BACTERIA = ta.ID_BACTERIA),
ta.ID_ANTIBIOGRAMA,ta.FENOTIPO,ta.FECHA_ANTIBIOGRAMA,ta.REPORTE_ACRODE_A_GUIA,ta.OBSERVACION_ANTIBIOGRAMA,
(SELECT b.NOM_BACTERIA from bacteria b WHERE b.ID_BACTERIA = te.ID_BACTERIA),
        te.ID_EPLEX,te.MEC_RESISTENCIA,te.FECHA_EPLEX,te.OBSERVACION_EPLEX
		
		FROM
		diagnostico d
		LEFT JOIN antibiotico__basado_en_antibiograma_manual abam ON d.ID_DIAGNOSTICO=abam.ID_DIAGNOSTICO
		LEFT JOIN pedido_examen px ON abam.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL=px.ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL
        LEFT JOIN recepcion_muestra_emocultivo rme ON px.ID_PEDIDO_EXAMEN = rme.ID_PEDIDO_EXAMEN 
        LEFT JOIN tincion_gram tg ON rme.ID_RECEPCION_MUESTRA_EMOCULTIVO = tg.ID_RECEPCION_MUESTRA_EMOCULTIVO
        LEFT JOIN tecnicas t ON tg.ID_GRAM = t.ID_GRAM
		LEFT JOIN tecnica_array tarray ON tarray.ID_ARRAY = t.ID_ARRAY
		LEFT JOIN tecnica_antibiograma ta ON ta.ID_ANTIBIOGRAMA = t.ID_ANTIBIOGRAMA
		LEFT JOIN tecnica_eplex te ON te.ID_EPLEX = t.ID_EPLEX;
		";

$resultado = mysqli_query ($conexion, $sql) or die (mysql_error ());

$historial = array();

 


while( $row = mysqli_fetch_array($resultado) ) {

$historial[] = array(
		'paciente'=>$row[0],
		'medico_diagnostico'=>$row[1],
		'id_diagnostico'=>$row[2],
		'enfermedad_1'=>$row[3],
		'enfermedad_2'=>$row[4],
		'conmentario_diagnostico'=>$row[5],
		'fecha_diagnostico'=>$row[6],
		'id_prescripcion'=>$row[7],
		'antibiotico_1'=>$row[8],
		'dosis_1'=>$row[9],
		'antibiotico_2'=>$row[10],
		'dosis_2'=>$row[11],
		'antibiotico_3'=>$row[12],
		'dosis_3'=>$row[13],
		'f_inicio'=>$row[14],
		'tiempo_dias'=>$row[15],
		'f_fin'=>$row[16],
		'escala'=>$row[17],
		'mantiene'=>$row[18],
		'descala'=>$row[19],
		'ajuste_dosis'=>$row[20],
		'id_examen'=>$row[21],
		'tipo_examen'=>$row[22],
		'fecha_examen'=>$row[23],
		'id_muestra'=>$row[24],
		'medico_laboratorio'=>$row[25],
		'fecha_mustra'=>$row[26],
		'n_frascos'=>$row[27],
		'resultado_muestra'=>$row[28],
		'id_tincion'=>$row[29],
		'fecha_gram'=>$row[30],
		'resultado_gram'=>$row[31],
		'alarma'=>$row[32],

		'id_tecnicas'=>$row[33],

		'bacteria_array'=>$row[34],
		'id_array'=>$row[35],
		'gen_resistencia'=>$row[36],
		'fecha_array'=>$row[37],
		'observacion_array'=>$row[38],

		'bacteria_antibiograma'=>$row[39],
		'id_antibiograma'=>$row[40],
		'fenotipo'=>$row[41],
		'fecha_antibiograma'=>$row[42],
		'reporte'=>$row[43],
		'observacion_antibiograma'=>$row[44],


		'bacteria_eplex'=>$row[45],
		'id_eplex'=>$row[46],
		'mec_resistencia'=>$row[47],
		'fecha_explex'=>$row[48],
		'observacion_eplex'=>$row[49]


	);
 
}

$jsonstring = json_encode($historial);
echo $jsonstring;


?>