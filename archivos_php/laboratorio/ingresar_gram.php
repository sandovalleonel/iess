<?php 


require '../../conexion_base/conexion_base.php';




if (isset($_POST['id_muestra'])) {


	$id_muestra = $_POST['id_muestra'];
	$combo_estado = $_POST['combo_estado'];
	$alarma = $_POST['alarma'];
	$numero_tecnicas = $_POST['numero_tecnicas'];
	
	$fecha =date('Y-m-d');

	$id = time()-1636237082;

	$sql = "INSERT INTO tincion_gram(ID_GRAM, ID_RECEPCION_EMOCULTIVO, FECH_GRAM, TREST_GRAM, ALARMA, NUM_TECNICAS) VALUES ($id,$id_muestra,'$fecha','','$alarma',$numero_tecnicas) ";


 
	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) 
		die("Error ingresar gram").mysqli_error($conexion);

	////////insercion segunda tabla
	$id2 = time()-1536237082;

	$sql2 = "INSERT INTO tipo_de_resultado(ID_GRAM, ID_ESTADO_TIPO_DE_RESULTADO, ID_TIPO_RESULTADO, NOM_RESULTADO) VALUES ($id,$combo_estado,$id2,'')";
 
	
	$resultado2 = mysqli_query($conexion, $sql2);

	if (!$resultado2) 
		die("Error ingresar gram2").mysqli_error($conexion);

	//ingresar gestionar notificacion

	$sql3 = "
INSERT INTO notificaciones(id_paciente, id_medico, id_diagnostico, id_pedido_examen, id_recepcion_muestra_emocultivo, id_antibiotico__basado_en_antibiograma_manua, id_tincion_gram, alarma, estado)

SELECT p.ID_PACIENTE,pm.ID_PERSONALMEDICO, d.ID_DIAGNOSTICO, pe.ID_PEDIDO, rme.ID_RECEPCION_EMOCULTIVO,abam.ID_ESTADO_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA ,tg.ID_GRAM ,tg.ALARMA,SUM(0+0)
FROM pacientes p, personal_medico pm,diagnostico d, pedido_examen pe,recepcion_muestra_emocultivo rme,tincion_gram tg, antibiotico__basado_en_antibiograma_manua abam
WHERE d.ID_PACIENTE=p.ID_PACIENTE AND
	  d.ID_PERSONALMEDICO=pm.ID_PERSONALMEDICO AND
      d.ID_DIAGNOSTICO=pe.ID_DIAGNOSTICO AND
      d.ID_DIAGNOSTICO=abam.ID_DIAGNOSTICO AND
      pe.ID_PEDIDO=rme.ID_PEDIDO AND
      rme.ID_RECEPCION_EMOCULTIVO=tg.ID_RECEPCION_EMOCULTIVO AND
      tg.ID_GRAM= $id
      ";

 $resultado3 = mysqli_query($conexion, $sql3);

if (!$resultado3) 
	die("Error ingresar gram3").mysqli_error($conexion);


	

	session_start();
	unset($_SESSION['l_s_id_muestra']);
	$_SESSION['l_s_id_tincion']=$id;
	echo "ok";
	 
}
?>