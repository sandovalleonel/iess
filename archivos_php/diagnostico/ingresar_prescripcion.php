<?php


require '../../conexion_base/conexion_base.php';
 

$jsonString = json_decode($_POST['myData'],true);
$tam_json = count($jsonString);


if ($jsonString[$tam_json-1]['id_diag']!=null) {


	$id = time();
	$id_diag = $jsonString[$tam_json-1]['id_diag']."\n";
    $comentario = $jsonString[$tam_json-1]['comentrio']."\n";

	$sql = "INSERT INTO `antibiotico__basado_en_antibiograma_manual`(`ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL`, `ID_DIAGNOSTICO`, `COMENTARIO`)
				 VALUES ($id,$id_diag,'$comentario')";
 
  	 

	$resultado = mysqli_query($conexion , $sql);

	 
	if (!$resultado) {
		die("error insertar archivo insertar_usuarios_sistema ".mysqli_error($conexion));
	}else{



		try{
			for ($i=0; $i < $tam_json ; $i++) { 
				if (count($jsonString[$i]) > 5) {
					$id2 = time() + $i + 1;
					$id_ant_name = $jsonString[$i]['id_ant'];
					$dosis = $jsonString[$i]['dosis'];
					$unidad = $jsonString[$i]['unidad'];
					$via = $jsonString[$i]['via'];
					$metodo = $jsonString[$i]['metodo'];
					$inicio = $jsonString[$i]['inicio'];
					$tiempo = $jsonString[$i]['tiempo'];
					$fin = $jsonString[$i]['fin'];
					$escala = $jsonString[$i]['escala'];
					$mantiene = $jsonString[$i]['mantiene'];
					$descala = $jsonString[$i]['descala'];
					$ajuste = $jsonString[$i]['ajuste'];

					$sql_ant = "INSERT INTO 
					`antibiotico_individual_completo`(`id_antibiotico_individual`, `ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL`,`ID_ANTIBIOTICO`, 
					`DOSIS`, `unidad`, `via`, `metodo`, `INICIO`, `TIEMPO`, `FIN`, `ESCALA`, `MANTIENE`, `DESCALA`, `AJUSTE_DOSIS`) 
					VALUES ($id2,$id,$id_ant_name,'$dosis','$unidad','$via','$metodo','$inicio',$tiempo,'$fin','$escala','$mantiene','$descala','$ajuste')"; 
					//echo $sql_ant;
					
					$resultado_ant = mysqli_query($conexion , $sql_ant);
				}
				
			}

		} catch (Exception $e) {
			echo 'Error guardar Enfermedades: '.$e->getMessage(), "\n";
			exit();
		}

		








		session_start();
		if (isset($_SESSION['ss_id_paciente'])) {
			
			unset($_SESSION['ss_id_paciente']);
			unset($_SESSION['ss_paciente']);}

		if (isset($_SESSION['ss_id_diagnostico'])) {
		  
			unset($_SESSION['ss_id_diagnostico']);
			unset($_SESSION['ss_diagnostico']);}

 
		echo "ok";
	 
		
	}
	
}

?>