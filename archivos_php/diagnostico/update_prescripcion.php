<?php


require '../../conexion_base/conexion_base.php';
 


$jsonString = json_decode($_POST['myData'],true);
$tam_json = count($jsonString);


if ($jsonString[$tam_json-1]['id_ant']!=null) {



	$id = $jsonString[$tam_json-1]['id_ant']."\n";
    $comentario = $jsonString[$tam_json-1]['comentario'];

	$sql = "UPDATE `antibiotico__basado_en_antibiograma_manual` SET `COMENTARIO`='$comentario' WHERE ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL = $id";
	$resultado = mysqli_query($conexion , $sql);

	$sql_delete = "DELETE FROM `antibiotico_individual_completo` WHERE ID_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA_MANUAL = $id";
	mysqli_query($conexion , $sql_delete);

	 
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

		


 
		echo "ok";
	 
		
	}
	
}

?>