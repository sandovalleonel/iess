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
	<title>Ver</title>
	<link rel="icon" href="../../imagenes/favicon.png">
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
		include("menu.php");
		?>

		<div class="col-1">	</div>

		<div class="col-xs-12 col-md-7  mt-5 shadow " >
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">LISTADO PACIENTES</button>
				</li>


			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

					<div class="col-5 pb-3 pt-3">
						<input type="text" id="buscar_paciente" class="form-control rounded" placeholder="Buscar" aria-label="Search"
						aria-describedby="search-addon" />
					</div>
					<div class="col-12  " style="height: 250px; overflow-y: scroll;">
						<table class="table table-bordered text-center" id="tabla_usuarios">
							<thead>
								<tr>
									<th>HISTORIA CLINICA</th>
									<th>NOMBRES</th>
									<th>EDAD</th>
									<th>GÉNERO</th>
									

								</tr>
							</thead>
							<tbody id="usuario_paciente">

							</tbody>
						</table>
					</div>
				</div>
				

			</div> 
		</div>








	</div>

	<?php 
	echo $footer;
	?>


	<!-- Modal  pacientes-->
	<div class="modal fade" id="modal_paciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar Paciente</h5>
				</div>
				<div class="modal-body">
					<form id="form_paciente">
						<div>
							<input type="hidden" name="id_paciente" id="id_paciente" value="">
							<label class="form-label">Historia clínica</label>
							<input class="form-control" type="number" name="historia_clinica_paciente" id="historia_clinica_paciente">
						</div>
						<div>

							<label class="form-label">Nombre</label>
							<input class="form-control" type="text" name="nombre_paciente" id="nombre_paciente">
						</div>
						<div>
							<label class="form-label">Apellido</label>
							<input class="form-control" type="text" name="apellido_paciente" id="apellido_paciente">
						</div>
						<div>
							<label class="form-label">Edad</label>
							<input class="form-control" type="number" name="edad_paciente" id="edad_paciente">
						</div>
						<div>
							<label class="form-label">Genero</label>
							<select class="form-select" name="genero_paciente" id="genero_paciente">
								<option>Masculino</option>
								<option>Femenino</option>
								<option>Otros</option>
							</select>
						</div>
						<div class="col text-center">
							<button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Cancelar</button>
							<button class="btn btn-primary my-3" id="btn_update_paciente">Actualizar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> 




	<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/iess/js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="/iess/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="/iess/js/sweetalert2.all.min.js"></script>
	<script type="text/javascript" src="/iess/js/mensaje_general.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
		 
			litar_pacientes();
			 

			function litar_pacientes(){

				$.ajax({
					url: '/iess/archivos_php/gestion_datos/consultar_paciente.php',
					type: 'GET',

					success: function(data) {
				  	//console.log(data);
				  	let lista_usuario = JSON.parse(data);
				  	let plantilla = '';

				  	lista_usuario.forEach(usuario=>{
				  		plantilla+=`

				  		<tr id_lista_usurios="${usuario.id_paciente}">

				  		<td>${usuario.historia_clinica}</td>
				  		

				  		<td>${usuario.apellido}  ${usuario.nombre}</td>
				  		<td>${usuario.edad}</td>
				  		<td>${usuario.genero}</td>
				  		<td> <button class="btn btn-info delete_paciente">Actualizar</button> </td>

				  		</tr>
				  		`;
				  	});
				  	$('#usuario_paciente').html(plantilla);
				  }



				});

			}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){

			$("#buscar_paciente").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#usuario_paciente tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
	</script>

	<script type="text/javascript">
		//autocompletar formularios
		$(document).on('click','.delete_paciente',function(){
			let elemento = $(this)[0].parentElement.parentElement;
			let id=$(elemento).attr('id_lista_usurios');
			$.post('/iess/archivos_php/gestion_datos/consultar_paciente.php',{id},function(response){
				
				$('#modal_paciente').modal('show');
				let lista_usuario = JSON.parse(response);
				//console.log(response); 
				$('#id_paciente').val(lista_usuario[0]['id_paciente']);
				$('#historia_clinica_paciente').val(lista_usuario[0]['historia_clinica']);
				$('#nombre_paciente').val(lista_usuario[0]['nombre']);
				$('#apellido_paciente').val(lista_usuario[0]['apellido']);
				$('#edad_paciente').val(lista_usuario[0]['edad']);
				$('#genero_paciente').val(lista_usuario[0]['genero']);
                //console.log(lista_usuario[0]['genero']);

			});

		});
 

		$(document).on('click', '.close_modal', function() {
		
			$('#modal_paciente').modal('hide');
		});
	</script>

	<script type="text/javascript">
		//actualizar doctor
		
		$(document).on('click', '#btn_update_paciente', function(event) {
			event.preventDefault();
			
			let data_form = $('#form_paciente').serialize();
			//console.log(data_form);
			$.post('/iess/archivos_php/gestion_datos/update_paciente.php', data_form, function(data) {
				if (data=="ok") {
					succes_refresh("Datos Actualizados","/iess/vistas/gestion_datos/ver_pacientes")
				}else{
					erro_message("No podemos actualizar!");
				}
				
			});

		});

	</script>

</body>
</html>