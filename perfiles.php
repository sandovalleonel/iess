<?php
session_start();
$usuario = $_SESSION['username'];
if (!isset($usuario)){
	header("location: index");
}

//date_default_timezone_set('America/Guayaquil');
//echo date("F j, Y, g:i a"); 

?> 


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
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
				<a href="vistas/diagnostico/mis_alertas"><button class="btn btn-lg btn-primary op"><h2>Alertas</h2></button></a>
				<a  href="vistas/usuarios/administrador"><button class="btn btn-lg btn-primary op"><h2>Gestión de Usuario</h2></button></a>
				<a href="vistas/diagnostico/diagnostico"><button class="btn btn-lg btn-primary op"><h2>Registro de Diagnóstico</h2></button></a>
				<a href="vistas/laboratorio/ver_pacientes"><button class="btn btn-lg btn-primary op"><h2>Laboratorio</h2></button></a>
				<a href="vistas/gestion_datos/agregar_medico"><button class="btn btn-lg btn-primary op"><h2>Gestión Datos</h2></button></a>

		 	</div>
			

		</div>
	</div>
	<script type="text/javascript" src="js/b_js/bootstrap.min.js"></script>
	

	<footer class='bg-primary m-0 row justify-content-end mt-3'>
		<div class='d-inline-block col-auto '>
			
			
		

			<img width='65px'  src='/iess/imagenes/footer1.jpeg'  class=' float-right py-1' >
			<img width='300px' src='/iess/imagenes/footer4.jpeg' class=' float-right py-0' >
		</div>
	</footer>

</body>

</html>
