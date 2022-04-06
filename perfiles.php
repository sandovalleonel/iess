<?php
session_start();
$usuario = $_SESSION['username'];
if (!isset($usuario)){
	header("location: index");
}

//date_default_timezone_set('America/Guayaquil');
//echo date("F j, Y, g:i a"); 
$rol = $_SESSION['categoria'];


?> 


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Perfil</title>
	<link rel="icon" href="imagenes/favicon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/b_css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/perfiles.css">
</head>
<body class="bg-light">	

	<?php
	include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/header.php");

	?>	

	<div class="container-fluid position-relative ">
		<div class="row">
			<div class="col-12 pt-2">
				
			</div> 

			<!--<div class="col-4 text-center ">
				<img src="/iess/imagenes/img1.jpeg" width="42%" class="img-thumbnail img-fluid" alt="Responsive image">
			</div>-->
			<div class="col-2"></div>
			<div class="col-xs-12 col-md-5 text-center pt-2 pb-1 mt-2  ">

				<img src="/iess/imagenes/body2.jpeg" width="75%" height="100%" class="img-thumbnail img-fluid shadow"  alt="Responsive image">
				
			</div>
			<div class="col-xs-12 col-md-3 pt-1 " >

				<?php 

					if ($rol == 1) {


						echo "
				<a href='vistas/diagnostico/mis_alertas'><button class='btn btn-lg btn-primary op'><h2>Alertas <label id='perfil_notificacion'> [0]</label></h2></button></a>
				<a  href='vistas/usuarios/administrador'><button class='btn btn-lg btn-primary op'><h2>Gestión de Usuario</h2></button></a>
				<a href='vistas/diagnostico/diagnostico'><button class='btn btn-lg btn-primary op'><h2>Registro de Diagnóstico</h2></button></a>
				<a href='vistas/laboratorio/ver_pacientes'><button class='btn btn-lg btn-primary op'><h2>Laboratorio</h2></button></a>
				<a href='vistas/gestion_datos/agregar_medico'><button class='btn btn-lg btn-primary op'><h2>Gestión Datos</h2></button></a>
				<a href='vistas/export_data/data'><button class='btn btn-lg btn-primary op'><h2>Exportar Data</h2></button></a>
				";
						
					}elseif ($rol == 2) {
						echo "
							<a href='vistas/diagnostico/mis_alertas'><button class='btn btn-lg btn-primary op'><h2>Alertas</h2></button></a>
							
							<a href='vistas/diagnostico/diagnostico'><button class='btn btn-lg btn-primary op'><h2>Registro de Diagnóstico</h2></button></a>
							<a href='vistas/credenciales/cambiar_pass'><button class='btn btn-lg btn-primary op'><h2>Cambiar Contraseña</h2></button></a>
							
						";
						
					}elseif($rol == 3){

						echo "<a href='vistas/laboratorio/ver_pacientes'><button class='btn btn-lg btn-primary op'><h2>Laboratorio</h2></button></a>
						<a href='vistas/credenciales/cambiar_pass'><button class='btn btn-lg btn-primary op'><h2>Cambiar Contraseña</h2></button></a>

						";


					}



				?>

				

		 	</div>
			

		</div>
	</div>
	
	

	<footer class='bg-primary m-0 row justify-content-end mt-3'>
		<div class='d-inline-block col-auto '>
			
			
		

			<img width='65px'  src='/iess/imagenes/footer1.jpeg'  class=' float-right py-1' >
			<img width='300px' src='/iess/imagenes/footer4.jpeg' class=' float-right py-0' >
		</div>
	</footer>


	<script type="text/javascript" src="js/b_js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/iess/js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" >
		

		mostrar_notificacion();

		function mostrar_notificacion(){	
		$.ajax({
		  url: '/iess/archivos_php/notificaciones/total_notificaciones.php',
		  type: 'GET',
		   
		  success: function(data) {
		  
			 $('#perfil_notificacion').text(`(${data})`);
		  }

		});
						}
	</script> 

</body>

</html>
