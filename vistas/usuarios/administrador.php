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
	<title>Administrador</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="../../css/b_css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/menu.css">
</head>
<body class="bg-light">
	
	

	<?php
	include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/header.php"); 
	?>
	<div class="">
		<div class="row">
			<?php
			include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar.php");
		//echo $navbar_usuarios;
			$python = `python3 menu.py`;
			echo $python; 
			?>

			<!-- Formulario 1*****************************************-->
			<div class="col-1"></div>
			<div class="col-xs-12 col-md-6 ">

				<div class="col-5 pb-3 pt-3">
					<input type="text" id="buscar_admin" class="form-control rounded" placeholder="Buscar" aria-label="Search"
					aria-describedby="search-addon" />
				</div>
				<div class="col-12  " style="height: 250px; overflow-y: scroll;">
					<table class="table table-bordered text-center" id="tabla_usuarios">
						<thead>
							<tr>
								<th>NOMBRE</th>
								<th>USUARIO</th>
								<th>CARGO</th>
								<th></th>
								<th></th>

							</tr>
						</thead>
						<tbody id="usuario_admin">

						</tbody>
					</table>
				</div>
			</div>
			<div class="col-xs-12 col-md-2  mt-3 ">
				<div class="alert alert-secondary" role="alert">
					<p class="h6 text-justify">La tabla contiene un listado de empleados que tienen acceso a nuestro sistema, si dese añadir dirigase al menú crear nuevo usuario.</p>
				</div>
			</div>

		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modal_actualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>

				</div>
				<div class="modal-body">
					<form id="cambiar_password">
						<input type="hidden" id="id_actualizar">
						<input required  class="form-control" type="text" id="new_password" placeholder="Nueva contraseña..">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_salir">Cancelar</button>
					<button type="button" class="btn btn-primary" id="btn_actualizar">Cambirar</button>
				</div>
			</div>
		</div>
	</div>



	<?php 
	echo $footer;
	?>



	<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/iess/js/sweetalert2.all.min.js"></script>
	<script type="text/javascript" src="/iess/js/mensaje_general.js"></script>

	<script type="text/javascript" src="/iess/js/usuarios_administrador/lista_general_usuarios.js"></script>
	<script type="text/javascript">

		$("#buscar_admin").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#usuario_admin tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
		

	</script>
	
	<script type="text/javascript">
		$(document).on('click','.update_user',function(){
			let elemento = $(this)[0].parentElement.parentElement;
			let id=$(elemento).attr('id_lista_usurios');
			$('#id_actualizar').val(id);
			$('#modal_actualizar').modal('show');
		});
		$(document).on('click','#btn_actualizar',function(){
			if ($('#new_password').val()!="") {
				var data_form={
					id:$('#id_actualizar').val(),
					pass:$('#new_password').val()
				}
				$.post('/iess/archivos_php/usuarios_administrador/update_password.php', data_form, function(data) {
					console.log(data)
					if (data=="ok") {
						$('#modal_actualizar').modal('hide');
						succes_message("Contraseña actualizada");
					}
				});
			}
			
		});
		$(document).on('click','#btn_salir',function(){
			$('#modal_actualizar').modal('hide');

		});
	</script>
</body>
</html>