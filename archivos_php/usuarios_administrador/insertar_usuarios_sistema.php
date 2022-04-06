<?php
require '../../conexion_base/conexion_base.php';
 

if (isset($_POST['usuario'])) {

	date_default_timezone_set('America/Guayaquil');


  	$llave = time();
	$fecha_creacion = date("Y-m-d"); 
	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];
	$clave = md5($clave);
	$id= $_POST['id'];




	$sql_insert = "INSERT INTO usuarios(ID_USUARIO,ID_PERSONALMEDICO, USUARIO, PASSWORD, FEC_CREACION) VALUES($llave,$id , '$usuario' , '$clave', '$fecha_creacion')";
	 

	$resultado = mysqli_query($conexion , $sql_insert);
	if (!$resultado) {
		die("error insertar archivo insertar_usuarios_sistema ".mysqli_error($conexion));
	}else{
		echo "ok";
	
	}

}
?>