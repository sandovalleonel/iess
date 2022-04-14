<?php 
 

require '../../conexion_base/conexion_base.php';


 
 
if (isset($_POST['id_examen'])) {
	session_start();


	$id=$_POST['id_examen']; 
	$n_frascos=$_POST['n_frascos'];


	

	$sql = "UPDATE `recepcion_muestra_emocultivo` SET `NUME_FRASCOS`='$n_frascos'
			WHERE `ID_RECEPCION_MUESTRA_EMOCULTIVO`=$id;";


 	
	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) 
		die("Error Actualizar muestra").mysqli_error($conexion);
	
	echo "ok";
}
?>