<?php


require '../../conexion_base/conexion_base.php';
 

if (isset($_POST['id_diagnostico'])) {
	date_default_timezone_set('America/Guayaquil');

	 $id_diagnostico =explode("-", $_POST['id_diagnostico']);
	  
	 $id_pedido = time()-1000000;
	 $id_tipo_examen = $_POST['id_tipo_examen'];
	 $fecha = date('Y-m-d H:i:s a');//$_POST['fecha'];

	$sql = "INSERT INTO pedido_examen(ID_DIAGNOSTICO, ID_PEDIDO, ID_TIPO_EXAMEN, FECHA_PEDIDO,id_prescripcion) 
	VALUES ($id_diagnostico[0],$id_pedido,$id_tipo_examen,'$fecha',$id_diagnostico[1])";
	 


	$resultado = mysqli_query($conexion , $sql);
	if (!$resultado) {
		die("error insertar archivo insertar_usuarios_sistema ".mysqli_error($conexion));
	}else{
 
		echo "ok";
 
	}
	
}
?>
