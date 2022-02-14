<?php
require '../../conexion_base/conexion_base.php';
 

if (isset($_POST['usuario'])) {

	date_default_timezone_set('America/Guayaquil');
  
	$fecha_creacion = date("Y-m-d H:i "); 
	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];
	$clave = md5($clave);


	$sql = "SELECT ID_PERSONALMEDICO FROM personal_medico WHERE CED_PERSONAL=$usuario";
	$id_medico = mysqli_query($conexion,$sql);
	$id="";

	if (!$id_medico) 
		die("error query archivo insertar_usuarios_sistema ".mysqli_error($conexion));

	while($row = mysqli_fetch_array($id_medico))
		$id = $row[0];

	


	$sql_insert = "INSERT INTO usuarios(ID_PERSONALMEDICO, USUARIO, PASSWORD, FEC_CREACION) VALUES($id , '$usuario' , '$clave', '$fecha_creacion')";
	 

	$resultado = mysqli_query($conexion , $sql_insert);
	if (!$resultado) {
		die("error insertar archivo insertar_usuarios_sistema ".mysqli_error($conexion));
	}else{
		echo "ok";
		//header("location: /iess/vistas/usuarios/administrador");
	}

}
?>