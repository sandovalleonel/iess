<?php 
 

require '../../conexion_base/conexion_base.php';


 
 
if (isset($_POST['id_examen'])) {
	session_start();

	$id = time()-1636237082;
	$id_examen=$_POST['id_examen'];

	$medico= $_SESSION['username'];
	 
	

	$f_recepcion=$_POST['f_recepcion'];
	$f_muestra=$_POST['fecha'];

	$n_frascos=$_POST['n_frascos'];
	$resultado=$_POST['resultado']; 

	

	$sql = "INSERT INTO `recepcion_muestra_emocultivo`(`ID_RECEPCION_MUESTRA_EMOCULTIVO`, `ID_PEDIDO_EXAMEN`, `NOMBRE_RESPONSABLE`, `FECHA_RECEPCION`, `FECH_MUESTRA`, `NUME_FRASCOS`, `RESULTADO`) 
	VALUES ($id,$id_examen,'$medico','$f_recepcion','$f_muestra','$n_frascos','$resultado')";


 	
	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) 
		die("Error ingresar doctor").mysqli_error($conexion);
	
	echo "ok";
}
?>