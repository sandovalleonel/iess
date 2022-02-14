<?php


require '../../conexion_base/conexion_base.php';
 
 if (isset($_POST['id_opcion'])) {
//1 mbf
//2 antibiograma
//3 bme 
$id = $_POST['id_opcion'];
$sql ="";

switch ($id) {
    case 1:
        $sql = "SELECT * FROM estado_bmo_film_array";
        break;
    case 3:
        $sql = "SELECT * FROM estado_bmo_eplex";
        break;
    case 2:
        $sql = "SELECT * FROM estado_atb_reporte order by ESTADO";
        break;
}

 
$resultado = mysqli_query($conexion ,$sql);

if (!$resultado)
	die("Error consultar_estados").mysqli_error($conexion);

$json = array();

while($row = mysqli_fetch_array($resultado)){
	$json[] = array(
		'id_estado'=>$row[0],
		'estado'=>$row[1] 

	);
}

$jsonstring = json_encode($json);
echo $jsonstring;
 }
 ?>