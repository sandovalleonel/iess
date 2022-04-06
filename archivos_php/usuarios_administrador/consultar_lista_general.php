<?php
require '../../conexion_base/conexion_base.php';

$sql = "SELECT  p.ID_PERSONALMEDICO ,p.CED_PERSONAL, CONCAT(p.NOM_PERSONAL,' ',p.APE_PERSONAL),p.CODIGO_AS400,(SELECT r.NOMBRE_CARGO from rol r WHERE r.CARGO=p.CARGO ) 
		FROM personal_medico p
 		 WHERE NOT EXISTS (SELECT * 
 		 				   FROM usuarios u
                		   WHERE u.ID_PERSONALMEDICO=p.ID_PERSONALMEDICO);";

$resultado = mysqli_query($conexion , $sql);

if (!$resultado) 
	die("Error query ".mysqli_error($conexion));

$json = array();

while($row = mysqli_fetch_array($resultado)){
	 
	echo "
		<tr id_lista_general='".$row[1]."'>
			<td id='id_personal' >".$row[0]."</td>
			<td >".$row[1]."</td>
			<td>".$row[2]."</td>
			<td>".$row[3]."</td>
			<td id='numero'>".$row[4]."</td>
			 
			<td> <button class='btn btn-info agregar_usuario' value='agregar'>  Agregar </button> </td>
		</tr>	
		";
}

///segunda consulta

 $sql = "SELECT p.ID_PERSONALMEDICO,  p.CED_PERSONAL, CONCAT(p.NOM_PERSONAL,' ',p.APE_PERSONAL),p.CODIGO_AS400,(SELECT r.NOMBRE_CARGO from rol r WHERE r.CARGO=p.CARGO ) 
		FROM personal_medico p
 		 WHERE  EXISTS (SELECT * 
 		 				   FROM usuarios u
                		   WHERE u.ID_PERSONALMEDICO=p.ID_PERSONALMEDICO);";

$resultado = mysqli_query($conexion , $sql);

if (!$resultado) 
	die("Error query ".mysqli_error($conexion));

$json = array();

while($row = mysqli_fetch_array($resultado)){
	 
	echo "
		<tr id_lista_general='".$row[1]."'>
			<td id='id_personal' >".$row[0]."</td>
			<td>".$row[1]."</td>
			<td>".$row[2]."</td>
			<td>".$row[3]."</td>
			<td id='numero'>".$row[4]."</td>
			 
			<td> <button class='btn btn-secondary agregar_usuario' value='agregado' >  Agregado </button> </td>
		</tr>	
		";
}
?>