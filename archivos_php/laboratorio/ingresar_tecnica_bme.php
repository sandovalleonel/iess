<?php 
 

require '../../conexion_base/conexion_base.php';


 
 
if (isset($_POST['id_gram'])) {

	 
date_default_timezone_set('America/Guayaquil');
	 $id_gram=$_POST['id_gram'];
	 $observacion=$_POST['observacion'];
	 $id_estado=$_POST['id_estado'];
	 $gen_resistencia=$_POST['gen_resistencia'];
	 $fecha=date('Y-m-d');

	$id = time()-1636237082;

	$sql = "INSERT INTO tincion_tecnica(ID_TINCION_TECNICA, ID_GRAM, ID_TIPO_TECNICA, OBSERVACION) 
			VALUES($id,$id_gram,3,'$observacion')";
			 
 	
	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) 
		die("Error ingresar tecnica bme_t1").mysqli_error($conexion);


	$id2 = time()-1636237082;

	

	$sql2="INSERT INTO biologia_molecular_eplex(ID_EPLEX, ID_ESTADO_BMO_EPLEX, ID_TINCION_TECNICA, ID_PEDIDO, TIPO_ID_BMO_EPLEX, MEC_RESISTENCI, FECHA) 
		VALUES ($id2,$id_estado,$id,0,0,'$gen_resistencia','$fecha')";

 	
	$resultado2 = mysqli_query($conexion, $sql2);

	if (!$resultado2) 
		die("Error ingresar tecnica bme_t2").mysqli_error($conexion);


	echo "ok";
	
}
?>