<?php
require '../../conexion_base/conexion_base.php';



$usuario = $_POST['usuario'];
$clave = $_POST['contrasenia'];
 
$clave = md5($clave);

$sql = "SELECT DISTINCT COUNT(*) contar,concat(p.NOM_PERSONAL,' ',p.APE_PERSONAL),p.CARGO ,p.ID_PERSONALMEDICO
FROM personal_medico p, usuarios u 
WHERE u.ID_PERSONALMEDICO=p.ID_PERSONALMEDICO and (u.USUARIO='$usuario' and u.PASSWORD='$clave')";


$consulta = mysqli_query($conexion, $sql);
$array = mysqli_fetch_array($consulta);
session_start();
if ($array['contar'] > 0) {
	$_SESSION['username'] = $array[1];
	$_SESSION['categoria'] = $array[2];	
	$_SESSION['id_medico'] = $array[3];

	header("location: ../../perfiles");
}else{
	$_SESSION['error'] = "Error";
	 
	header("location: ../../index");
}

?>