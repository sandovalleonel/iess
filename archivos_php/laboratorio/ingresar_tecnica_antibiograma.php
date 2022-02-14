<?php 
 

require '../../conexion_base/conexion_base.php';
 
if (isset($_POST['id_gram'])) {

	 
date_default_timezone_set('America/Guayaquil');
	 $id_gram=$_POST['id_gram'];
	 $observacion=$_POST['observacion'];
	 $id_estado=$_POST['id_estado'];
 	 $reporte_guia=$_POST['reporte_guia'];
 	 $fenotipo=$_POST['fenotipo'];
				 
	 $fecha=date('Y-m-d');

	$id = time()-1636237082;

	$sql = "INSERT INTO tincion_tecnica(ID_TINCION_TECNICA, ID_GRAM, ID_TIPO_TECNICA, OBSERVACION) 
			VALUES($id,$id_gram,2,'$observacion')";
			 
 	
	$resultado = mysqli_query($conexion, $sql);

	if (!$resultado) 
		die("Error ingresar tecnica antibiograma_t1").mysqli_error($conexion);


	$id2 = time()-1636237082;

	


	$sql2="INSERT INTO antibiograma(ID_ANTIBIOGRAMA, ID_ESTADO_ATB_AL_MOMENTO, ID_TINCION_TECNICA, FECHA_ANTIBIOGRMA, REPORTE_ACRODE_A_GUIA, FENOTIPO) 
		VALUES ($id2,$id_estado,$id,'$fecha','$reporte_guia','$fenotipo')";

 	
	$resultado2 = mysqli_query($conexion, $sql2);

	if (!$resultado2) 
		die("Error ingresar tecnica antibiograma_t2").mysqli_error($conexion);


	echo "ok";
	
}
?>