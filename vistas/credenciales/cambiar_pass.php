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

			<!-- Formulario 1*****************************************-->

			<div class="col-3"></div>

			<div class="col-xs-12 col-md-6 ">
				<a href="/iess/perfiles" class="btn btn-primary mt-5" >Regresar</a>

			
				<div class="col-12 pt-5 " >
					<table class="table table-bordered text-center" id="tabla_usuarios">
						<thead>
							<tr>
								<th>NOMBRE</th>
								<th>USUARIO</th>
								
								<th></th>
								

							</tr>
						</thead>
						<tbody id="usuario_comun">

						</tbody>
					</table>
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
					<button type="button" class="btn btn-primary" id="btn_actualizar">Cambiar</button>
				</div>
			</div>
		</div>
	</div>



	



	<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../js/sweetalert2.all.min.js"></script>
	<script type="text/javascript" src="../../js/mensaje_general.js"></script>

	<script type="text/javascript" src="../../js/usuarios_administrador/lista_general_usuarios.js"></script>
 
	
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
				$.post('../../archivos_php/usuarios_administrador/update_password.php', data_form, function(data) {
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




	<script type="text/javascript">
		litar_usuarios();
		function litar_usuarios(){

		$.ajax({
		  url: '/iess/archivos_php/cambiar_clave_individual/datos.php',
		  type: 'GET',
		   
		  success: function(data) {
		  	//console.log(data);
		    let lista_usuario = JSON.parse(data);
		    let plantilla = '';

		    lista_usuario.forEach(usuario=>{
		    	plantilla+=`

		    		<tr id_lista_usurios="${usuario.id}">
		    		 
		    			<td>${usuario.nombre}</td>
		    			<td>${usuario.usuario}</td>
		    			
		    			
		    			<td> <button class="btn btn-info update_user">Editar</button> </td>
		    			
		    		</tr>
		    	`;
		    });
		    $('#usuario_comun').html(plantilla);
		  }

		 

		});
 
	}
	</script>
</body>
</html>