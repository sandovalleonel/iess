<?php
	session_start();
	$usuario = $_SESSION['username'];
	if (!isset($usuario)){
		header("location: ../../index.php");
	}


	

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	 <link rel="stylesheet" type="text/css" href="../../css/b_css/bootstrap.min.css">
	 <link rel="stylesheet" type="text/css" href="../../css/menu.css">
</head>
<body>
	
 
 	<?php
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/header.php");
		 
	?>

 	<div class="row">
 		<?php
			include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar.php");
			echo $navbar_diagnostico; 
		?>
 
 		<div class="col-1">	</div>
 <!-- Formulario 1*****************************************-->
 		<div class="col-6  mt-5 shadow"  >
 			<h6 class="text-center">Formulario Diagnóstico Médico</h6>

 			<div class="container ">
 				<form action="#">
 					<div>
 						<label class="form-label">Doctor</label>
 						<input class="form-control" type="text" name="" value="<?php echo $usuario ?>" disabled>
 					</div>
 					<div>
 						<label class="form-label">Paciente</label>
 						<input class="form-control" type="text" name="" disabled>
 					</div>
 					<div>
 						<label class="form-label">Inicio de Antibiótico</label>
 						<input class="form-control" type="text" name="" >
 					</div>
 					<div>

 						<label class="form-label">N° Prescribe</label>
 						<input class="form-control" type="text" name="">
 					</div>
 					<div>
 						<label class="form-label">Continua con el Antibiotico</label>
 						<input class="form-control" type="text" name="">
 					</div>

  					<div>

 						<label class="form-label">Tipo de Antibiotico</label>
 						<input class="form-control" type="text" name="">
 					</div>
 					<div>
 						<label class="form-label">Dosis</label>
 						<input class="form-control" type="text" name="">
 					</div>					
 					<button class="btn btn-primary my-3">Crear</button>
 				</form>
 			</div>
 		</div>
  <!-- Formulario 1*****************************************-->




  
 	</div>


  <script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
</body>
</html>