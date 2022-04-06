<?php


require '../../conexion_base/conexion_base.php';
 

if (isset($_POST['id_diagnostico'])) {
	date_default_timezone_set('America/Guayaquil');


	 $id_pedido = time()-1000000;
	 $id_aux =($_POST['id_diagnostico']);
	 $id_tipo_examen = $_POST['id_tipo_examen'];
	 $fecha = date("Y-m-d H:i");//$_POST['fecha'];

	$sql = "INSERT INTO `pedido_examen`(`ID_PEDIDO_EXAMEN`, `ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL`, `TIPO_EXAMEN`, `FECHA_PEDIDO`) VALUES ($id_pedido,$id_aux,'$id_tipo_examen','$fecha')";
	 


	$resultado = mysqli_query($conexion , $sql);
	if (!$resultado) {
		die("error insertar archivo insertar_usuarios_sistema ".mysqli_error($conexion));
	}else{
 
		echo "ok";
 
	}
	
}
?>
