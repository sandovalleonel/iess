<?php 

if ($_POST['array_data']) {

 
	$data = json_decode($_POST['array_data']);
	$id_pedido_examen= $data[0];
	$id_diagnostico= $data[1];
	$diagnostico= $data[2];
	$id_paciente= $data[3];
	$paciente= $data[4];
	$id_medico= $data[5];
	$medico= $data[6];

	 
	
	session_start();

	$_SESSION['l_s_id_diagnostico']=$id_diagnostico;
	$_SESSION['l_s_id_paciente']=$id_paciente;
	$_SESSION['l_s_id_medico']=$id_medico;
	$_SESSION['l_s_id_pedido_examen']=$id_pedido_examen;
	$_SESSION['l_s_paciente']=$paciente;
	$_SESSION['l_s_medico']=$medico;
	$_SESSION['l_s_diagnostico']=$diagnostico;
}
?>