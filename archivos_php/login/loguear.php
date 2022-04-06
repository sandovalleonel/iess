<?php
require '../../conexion_base/conexion_base.php';



$usuario = $_POST['usuario'];
$clave = $_POST['contrasenia'];
 
$clave = md5($clave);

$sql = "SELECT CONCAT(p.NOM_PERSONAL,' ',p.APE_PERSONAL) username,p.CARGO categoria,p.ID_PERSONALMEDICO id_medico
FROM personal_medico p, usuarios u 
WHERE u.ID_PERSONALMEDICO=p.ID_PERSONALMEDICO 
and (u.USUARIO='$usuario' and u.PASSWORD='$clave')";

//echo $sql;
//exit;
$consulta = mysqli_query($conexion, $sql);
$array = mysqli_fetch_array($consulta);
session_start();



if ($array['id_medico'] != null ) {
	$_SESSION['username'] = $array[0];
	$_SESSION['categoria'] = $array[1];	
	$_SESSION['id_medico'] = $array[2];

	header("location: ../../perfiles");
}else{
	$_SESSION['error'] = "Error";
	 
	header("location: ../../index");
}

?>