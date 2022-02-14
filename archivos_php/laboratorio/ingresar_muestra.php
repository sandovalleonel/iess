<?php 
 

require '../../conexion_base/conexion_base.php';


 
 
if (isset($_POST['id_examen'])) {

	 
	$id_examen=$_POST['id_examen'];
	$doctor=$_POST['doctor'];
	$f_rcepcion=$_POST['f_rcepcion'];
	$f_muestra=$_POST['f_muestra'];
	$f_alarma=$_POST['f_alarma'];
	$n_frascos=$_POST['n_frascos'];
	$resultado=$_POST['resultado']; 

	$id = time()-1636237082;
	$sql = "INSERT INTO recepcion_muestra_emocultivo(ID_RECEPCION_EMOCULTIVO, ID_PEDIDO, ID_ESTADO_EMOCULTIVO, NOMBRE_RESPONSABLE, FECH_MUEST_HEMO, FECHA_ALAR_HEMO, NUME_FRASCOS, RESULTADO, FECHA_RECEPCION)
	 VALUES ($id,$id_examen,1,'$doctor','$f_muestra','$f_alarma',$n_frascos,'$resultado','$f_rcepcion')";

 	
	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) 
		die("Error ingresar doctor").mysqli_error($conexion);

	
	session_start();
	$_SESSION['l_s_id_muestra'] = $id;
	echo "ok";
}
?>