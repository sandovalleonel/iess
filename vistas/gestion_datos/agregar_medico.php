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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" type="text/css" href="../../css/b_css/bootstrap.min.css">
	 <link rel="stylesheet" type="text/css" href="../../css/menu.css">
	 <link rel="stylesheet" type="text/css" href="/iess/css/mensaje_error.css">
</head>
<body>
	
 
 	<?php
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/header.php");
		 
	?>

 	<div class="row">
 		<?php
			include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar.php");
			//echo $navbar_gesios_datos; 
			$python = `python3 menu.py`;
			echo $python; 
		?>
 
 		<div class="col-1">	</div>
 <!-- Formulario 1*****************************************-->
 		<div class="col-xs-12 col-md-6  mt-5 shadow"  >
 			<h6 class="text-center pt-3">FORMULARIO AGREGAR MÉDICO</h6>

 			<div class="container ">
 				<form id="form_medico">
 					<div>
 						<label class="form-label">Cédula</label>
 						<input class="form-control" type="text" name="cedula" id="cedula" >
 					</div>
 					<div>
 						<label class="form-label">Código AS400</label>
 						<input class="form-control" type="text" name="codigo" id="codigo" >
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
 						<label class="form-label">Cargo</label>
 						<select class="form-select" id="cargo" name="cargo">
 							<option></option>
 							<option value="Doctor">Doctor</option>
 							<option value="Administrador">Administrador</option>
 						</select> 
 						</div>	
 						<div class="col text-center">				
 					<button class="btn btn-primary my-3" id="btn_crear">Crear</button>
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
  <script type="text/javascript" src="/iess/js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="/iess/js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="/iess/js/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="/iess/js/mensaje_general.js"></script>

  <script type="text/javascript">
  	$(document).ready(function(){
  		$('#form_medico').validate({
  			rules:{
  				cedula:{
  					required:true,
  					minlength:10,
  					maxlength:10
  				},
  				codigo:{
  					required:true
  				},
  				nombre:{
  					required:true,
  					minlength:3
  				},
  				apellido:{
  					required:true,
  					minlength:3
  				},
  				cargo:{
  					required:true
  				}
  			},
  			messages:{
  				cedula:{
  					required:"Campo vacío",
  					minlength:"La cédula tiene 10 dígitos",
  					maxlength:"La cédula tiene 10 dígitos"
  					
  				},
  				codigo:{
  					required:"Campo vacío"
  				},
  				nombre:{
  					required:"Campo vacío",
  					minlength:"Debe tener más de 2 letras"
  				},
  				apellido:{
  					required:"Campo vacío",
  					minlength:"Debe tener más de 2 letras"
  				},
  				cargo:{
  					required:"Seleccione un elemento"
  				}
  			},
  			submitHandler:function(){
  				ingresar_medico();
  			}

  		});
  	})
  </script>
  <script type="text/javascript">

  	function ingresar_medico(){
  		let data_form = $('#form_medico').serialize();
  		$.post( "/iess/archivos_php/gestion_datos/insert_doctor.php",data_form, function( data ) {
  			if (data=='ok') {
  				succes_refresh("Datos guardados correctamente","/iess/vistas/gestion_datos/agregar_medico");

  			}else {
  				erro_message("Erro al guardar");
  			}		
  		});

  	}
 
  </script>
</body>
</html>