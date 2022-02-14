<?php
session_start();

if (isset($_SESSION['username'])){
	header("location: perfiles");
}



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/b_css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/mensaje_error.css">
</head>
<body>
	

	<div class="container-fluid">
		<div class="row">
			<div class="col-1"></div>
			<div class="col-xs-12 col-md-4  mt-5">
				<img  class="img-fluid" src="imagenes/logo_index.jpg">
			</div>
			<div class="col-xs-12 col-md-4  mt-5 shadow pt-5">
				<?php
				if (isset($_SESSION['error'])){

					echo	'<div class="alert alert-danger text-center error_general" role="alert" style="">
					Usuario o Contraseña Incorrectos

					</div>';
					unset($_SESSION['error']);
				}
				?>
				<form method="post"  class="" id="form-login" action="archivos_php/login/loguear.php">
					<div>
						<label class="form-label">Usuario</label>
						<input class="form-control" type="text" name="usuario"  id="usuario"  >
					</div>
					<div>
						<label class="form-label">Contraseña</label>
						<input class="form-control" type="password" name="contrasenia" id="contrasenia" >
					</div>
					<button class="btn btn-primary mt-4 my-3" type="submit" id="btn_login">Entrar</button>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/b_js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#form-login").validate({
				rules:{
					usuario:{
						required: true
					},
					contrasenia:{
						required:true
					}

				},

				messages : {
					usuario: {
						required: "Campo requerido *"
					},
					contrasenia: {
						required: "Campo requerido *"
					}
				}
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			setTimeout(function() {
				// Declaramos la capa mediante una clase para ocultarlo
				$(".error_general").fadeOut(1000);
			},2000);
		});
	</script>

 
</body>
</html>