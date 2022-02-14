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
	<link rel="stylesheet" type="text/css" href="../../css/tecnicas.css">
	<link rel="stylesheet" type="text/css" href="../../css/menu.css">
</head>
<body>
	

	<?php
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/header.php");
		 
	?>

	<div class="row">
		<div class="col-2 ">
			<nav class="navbar bg-primary border-top d-block">
				<ul class="nav navbar-nav ">
					<li class="nav-item border-bottom menu">
						<a href="muestras" class="nav-link text-white">&nbsp;Muestras</a>
					</li>
					<li class="nav-item border-bottom menu">
						<a href="tincion_gram" class="nav-link text-white">&nbsp;Tinción de Gram</a>
					</li>
					<li class="nav-item border-bottom menu" id="submenu_tecnicas">
						<a href="#" class="nav-link text-white dropdown-toggle" data-toggle="dropdown" id="contr_submenu">&nbsp;Técnicas</a>
						<div class="dropdown-menu bg-primary border-top" aria-labelledby="navbarDropdown" style="display: none; position: absolute; left: 50px;" id="id_sumbenu">
							<a class="dropdown-item menu text-white border-bottom" href="https://www.youtube.com">B.M.F</a>
							<a class="dropdown-item menu text-white border-bottom" href="www.facebook.com">ANTIBIOGRAMA</a>
							<a class="dropdown-item menu text-white border-bottom" href="www.google.com">B.M.E</a>

						</div>

					</li>
				</ul>

			</nav>	


		</div>

		<div class="col-1">	</div>
		<!-- Formulario 1*****************************************-->
		<div class="col-6  mt-5 "  >

			<h6 class="text-center h5">Seleccione las Técnicas Necesarias</h6>

			<div class="container-fluid ">

				<div class="form-check form-check-inline col-4">
					<input class="form-check-input mn" type="checkbox" name="inlineRadioOptions" id="rad1" value="option1">
					<label class="form-check-label" for="rad1">Técnica B.M.F</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input mn" type="checkbox" name="inlineRadioOptions" id="rad2" value="option2">
					<label class="form-check-label" for="rad2">Técnica ANTIBIOGRAMA</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input mn" type="checkbox" name="inlineRadioOptions" id="rad3" value="option3">
					<label class="form-check-label" for="rad3">Técnica B.M.E</label>
				</div>
				
				<div class="row pt-3" >	
					<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++-->		 
					<div class="col-12 shadow" style="display: none;" id="f1">
						<h5 class="text-center pt-3">Formulario B.M.F</h5>
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
					<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div class="col-12 shadow" style="display: none;" id="f2">
						<h5 class="text-center pt-3">Formulario ANTIBIOGRAMA</h5>
						<form action="#">
							<div class="form-group">
								<label for="exampleInputEmail1">Id Muestra</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">ID Paciente</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">ID</label>
								<input type="text" class="form-control">

							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Identificacion Bacteria</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Fenotipo</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Fecha</label>
								<input type="date" class="form-control">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Reporte Acorde a Guia</label>
								<input type="text" class="form-control">
							</div>


							<div class="form-group">
								<label for="exampleInputEmail1">Antibiótico</label>
								<select class="form-select">

								</select>

							</div>

							<button type="submit" class="btn btn-primary my-3" id="btn_antibiograma">Guardar</button>
						</form>						
					</div>
					<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++-->
					<div class="col-12 shadow" style="display: none;" id="f3">
						<h5 class="text-center pt-3">Formulario B.M.E</h5>
						<form  action="#">
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
								<label for="exampleInputEmail1">Mec Resistencia</label>
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

							<button type="submit" class="btn btn-primary my-3" id="btn_bme">Guardar</button>
						</form>
					</div>
				</div>


			</div>
		</div>

		<!-- Formulario 1*****************************************-->





	</div>

	<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
	<script type="text/javascript" >

		var estado=[];
		var panel=['f1','f2','f3'];

		function redireccion_panel(inicio){
			for (var i = inicio; i <= 3; i++) {
				$('#f1').hide();
				$('#f2').hide();
				$('#f3').hide();
				if (estado[i]) {
					$('#'+panel[i]).show();
					break;
				}

			}
		}

		$('.mn').click(function(){

			
			estado[0]=$('#rad1').is(":checked");
			estado[1]=$('#rad2').is(":checked");
			estado[2]=$('#rad3').is(":checked");

			redireccion_panel(0);

		});


		$('#btn_bmf').click(function(){
			redireccion_panel(1);
		});
		$('#btn_antibiograma').click(function(){
			redireccion_panel(2);
		});

		$('#btn_bme').click(function(){
			$('#f3').hide();
		});


		$('#submenu_tecnicas').hover(function(){
			 $('#id_sumbenu').show();
    }, function(){
     $('#id_sumbenu').hide();
  
		});

		
	</script>
</body>
</html>