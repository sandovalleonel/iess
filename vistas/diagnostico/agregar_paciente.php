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
	<title>Agregar paciente</title>
	<link rel="icon" href="../../imagenes/favicon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" type="text/css" href="../../css/b_css/bootstrap.min.css">
	 <link rel="stylesheet" type="text/css" href="../../css/menu.css">
	 <link rel="stylesheet" type="text/css" href="../../css/mensaje_error.css">
</head>
<body>
	
 
 	<?php
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/header.php");
		 
	?> 

 	<div class="row">
 		<?php
			include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar.php");
			//echo $navbar_gesios_datos; 
			include("menu.php");
		?>
 
 		<div class="col-1">	</div>
 <!-- Formulario 1*****************************************-->
 		<div class="col-xs-12 col-md-6  mt-5 shadow"  >
 			<h6 class="text-center pt-3">FORMULARIO AGREGAR PACIENTE</h6>

 			<div class="container ">
 				<form id="form_paciente">
 					<div>
 						<label class="form-label">Historia clínica</label>
 						<input class="form-control" type="number" name="historia_clinica" id="historia_clinica">
 					</div>
 					<div>

 						<label class="form-label">Nombre</label>
 						<input class="form-control" type="text" name="nombre" id="nombre">
 					</div>
 					<div>
 						<label class="form-label">Apellido</label>
 						<input class="form-control" type="text" name="apellido" id="apellido">
 					</div>
 					<div>
 						<label class="form-label">Edad</label>
 						<input class="form-control" type="number" name="edad" id="edad">
 					</div>
 					<div>
 						<label class="form-label">Género</label>
 						<select class="form-select" name="genero" id="genero">
 							<option></option>
 							<option>Masculino</option>
 							<option>Femenino</option>
 							<option>Otros</option>
 						</select>
 					</div>
 					<div class="col text-center">
 					<button class="btn btn-primary my-3" id="btn_crear_paciente__">Crear</button>
 				</div>
 				</form>
 			</div>
 		</div>
  <!-- Formulario 1*****************************************-->




  
 	</div>
 	<?php 
	echo $footer;
	?>


  <script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="../../js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="../../js/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="../../js/mensaje_general.js"></script>

 

  <script type="text/javascript">
  	$(document).ready(function(){

  		$('#form_paciente').validate({
  				rules:{
  					historia_clinica:{
  						required:true
  					},
  					nombre:{
  						required:true
  					},
  					apellido:{
  						required:true
  					},
  					edad:{
  						required:true,
  						min:0,
  						max:125
  					},
  					genero:{
  						required:true
  					}

  				},
  				messages:{
  					historia_clinica:{
  						required:"Campo vacío"
  					},
  					nombre:{
  						required:"Campo vacío"
  					},
  					apellido:{
  						required:"Campo vacío"
  					},
  					edad:{
  						required:"Campo vacío",
  						min:"Edad debe ser mayor a 0",
  						max:"Edad debe ser menor a 125"
  					},
  					genero:{
  						required:"Seleccione un elemento"
  					}
  				},
  				 submitHandler:function(){
  				 	ingresar();
  				 }

  			});
  		
  	});
  </script>

  <script type="text/javascript">
  	function ingresar(){

  			let data_form = $('#form_paciente').serialize();

  			$.post('../../archivos_php/gestion_datos/insert_paciente.php',data_form,function(data){
  				console.log(data);
  				if (data=='ok') {
  					succes_refresh("Datos guardados correctamente","../../vistas/diagnostico/diagnostico");
  				}else if (data=="existe_1") {
  				erro_message("Error historia duplicada");
  				}	else {
  					erro_message("Error al guardar");
  					 
  				}
  			}); 
  	 
  	}
  </script>
</body>
</html>