<?php


require '../../conexion_base/conexion_base.php';

$sql ="select * from bacteria order by nom_bacteria";



 
$resultado = mysqli_query($conexion ,$sql);

if (!$resultado)
	die("Error consultar_estados").mysqli_error($conexion);


		echo "<option value='2' > NO APLICA </option>";
while($row = mysqli_fetch_array($resultado)){
	 
		echo "<option value='$row[0]' > $row[1] </option>";

 
}


 
 ?>