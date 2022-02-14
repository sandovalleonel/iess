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
			//echo $navbar_laboratorio; 
			$python = `python3 menu.py`;
			echo $python; 
		?>

		<div class="col-1">	</div>
		<!-- Formulario 1*****************************************-->
		<div class="col-6  mt-5 shadow"  >
			<h6 class="text-center">Formulario de B.M.F</h6>

			<div class="container ">
				<form action="#">
					<div class="form-group">
						<label for="exampleInputEmail1">Id Muestra</label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1"> Id Paciente</label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Recepción Muestra</label>
						<select class="form-select"> 

						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tipo iD</label>
						<select class="form-select">

						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Gen Resistencia</label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Fecha</label>
						<input type="date" class="form-control">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Estado</label>
						<select class="form-select">

						</select>

					</div>

					<button type="submit" class="btn btn-primary my-3" id="btn_bmf">Guardar</button>
				</form>

			</div>
		</div>
		<!-- Formulario 1*****************************************-->





	</div>

	<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$('#submenu_tecnicas').hover(function(){
			$('#id_sumbenu').show();
		}, function(){
			$('#id_sumbenu').hide();

		});
	</script>
</body>
</html>