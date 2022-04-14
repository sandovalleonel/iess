<?php 

if(isset($_POST['id_diagnostico'])){
    require '../../conexion_base/conexion_base.php';
 
    $id_diag = $_POST['id_diagnostico'];
    $comm = $_POST['diagnostico_descripcion']; 
    $enfermedades_id = $_POST['enfermedades_id'];

    $sql="UPDATE diagnostico SET DIAGNOSTICO_COMENTARIO = '$comm' WHERE ID_DIAGNOSTICO = $id_diag";
	$resultado = mysqli_query($conexion , $sql);


    $sql_delete = "UPDATE enf_diag SET ESTADO=0 WHERE  `ID_DIAGNOSTICO` = $id_diag";
    mysqli_query($conexion , $sql_delete);

    try {
		
		for ($i=0; $i < count($enfermedades_id) ; $i++) { 


			$cod_enf =  $enfermedades_id[$i];
			$id_enf = time()+$i+1;

			$sql_enf = "INSERT INTO `enf_diag`(`id_enf_diag`, `ID_ENFERMEDAD`, `ID_DIAGNOSTICO`,`ESTADO`) VALUES ($id_enf,$cod_enf,$id_diag,1)";
			
			$resultado_enf = mysqli_query($conexion , $sql_enf);
			
		}
		
	} catch (Exception $e) {
		echo 'Error guardar Enfermedades: '.$e->getMessage(), "\n";
		exit();
	}


    if (!$resultado) {
		die("error Actualizar archivo insertar_usuarios_sistema ".mysqli_error($conexion));
	}else{

		echo "ok";
 
	}

}
?>