<?php 
 
 
require '../../conexion_base/conexion_base.php';

	$sql = " SELECT vd.paciente ,vd.HIST_CLINICA,vd.medico,vd.ID_PEDIDO_EXAMEN,vd.TIPO_EXAMEN,vd.FECHA_PEDIDO,
        rme.ID_RECEPCION_MUESTRA_EMOCULTIVO, rme.FECH_MUESTRA,rme.NUME_FRASCOS, rme.RESULTADO,
        tg.ID_GRAM,tg.FECHA_GRAM,tg.RESULTDO_GRAM,tg.ALARMA,
        t.ID_TECNICAS,

        (SELECT b.NOM_BACTERIA from bacteria b WHERE b.ID_BACTERIA = tarray.ID_BACTERIA),
        tarray.ID_ARRAY,tarray.GEN_RESISTENCIA,tarray.FECHA_ARRAY,tarray.OBSERVACION_ARRAY,
        (SELECT b.NOM_BACTERIA from bacteria b WHERE b.ID_BACTERIA = ta.ID_BACTERIA),
        ta.ID_ANTIBIOGRAMA,ta.FENOTIPO,ta.FECHA_ANTIBIOGRAMA,ta.REPORTE_ACRODE_A_GUIA,ta.OBSERVACION_ANTIBIOGRAMA,
        (SELECT b.NOM_BACTERIA from bacteria b WHERE b.ID_BACTERIA = te.ID_BACTERIA),
        te.ID_EPLEX,te.MEC_RESISTENCIA,te.FECHA_EPLEX,te.OBSERVACION_EPLEX,t.FECHA_TECNICAS
             

FROM v_diagnostico vd
LEFT JOIN 
recepcion_muestra_emocultivo rme ON vd.ID_PEDIDO_EXAMEN = rme.ID_PEDIDO_EXAMEN
LEFT JOIN
tincion_gram tg ON rme.ID_RECEPCION_MUESTRA_EMOCULTIVO = tg.ID_RECEPCION_MUESTRA_EMOCULTIVO
LEFT JOIN
tecnicas t ON tg.ID_GRAM = t.ID_GRAM
LEFT JOIN
tecnica_array tarray ON tarray.ID_ARRAY = t.ID_ARRAY
LEFT JOIN
tecnica_antibiograma ta ON ta.ID_ANTIBIOGRAMA = t.ID_ANTIBIOGRAMA
LEFT JOIN
tecnica_eplex te ON te.ID_EPLEX = t.ID_EPLEX

ORDER BY vd.ID_PEDIDO_EXAMEN DESC

LIMIT 100
;";

$resultado = mysqli_query($conexion , $sql);
 
if (!$resultado) 
	die("Error query ".mysqli_error($conexion));

$json = array();

while($row = mysqli_fetch_array($resultado)){

		if($row[13]==1){ $aux_alarma = "SI"; } else{ $aux_alarma="NO"; }
	
	$json[] = array(
		'paciente'=>$row[0],
		'h_clinica'=>$row[1],
		'medico'=>$row[2],
		'id_pedido_examen'=>$row[3],
		'tipo_examen'=>$row[4],
		'fecha_examen'=>$row[5],

		'id_muestra'=>$row[6],
		'fecha_muestra'=>$row[7],
		'num_frascos'=>$row[8],
		'resultado'=>$row[9],

		'id_gram'=>$row[10],
		'fecha_gram'=>$row[11],
		'resultado_gram'=>$row[12],
		'alarma'=>$aux_alarma,

		'id_tecnicas'=>$row[14],

		'bacteria_array'=>$row[15],
		'id_array'=>$row[16],
		'gen_resistencia'=>$row[17],
		'fecha_array'=>$row[18],
		'observacion_array'=>$row[19],

		'bacteria_antibiograma'=>$row[20],
		'id_antibiograma'=>$row[21],
		'fenotipo'=>$row[22],
		'fecha_antibiograma'=>$row[23],
		'reporte'=>$row[24],
		'observacion_antibiograma'=>$row[25],


		'bacteria_eplex'=>$row[26],
		'id_eplex'=>$row[27],
		'mec_resistencia'=>$row[28],
		'fecha_explex'=>$row[29],
		'observacion_eplex'=>$row[30],

		'f_tecnicas'=>$row[31]






	);
		
} 

$jsonstring = json_encode($json);
echo $jsonstring;
?>