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
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">LISTADO MÉDICO/PERSONAL</button>
				</li>
				 

			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

					<div class="col-5 pb-3 pt-3">
						<input type="text" id="buscar_doctor" class="form-control rounded" placeholder="Buscar" aria-label="Search"
						aria-describedby="search-addon" />
					</div>
					<div class="col-12  " style="height: 250px; overflow-y: scroll;">
                    <table class="table table-bordered text-center" id="tabla_usuarios" >
							<thead>
								<tr>
									<th>Cédula</th>
									<th>Código AS400</th>
									<th>Nombre</th>
									<th>Cargo</th>


								</tr>
							</thead>
							<tbody id="usuario_doctor" >

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
 

	<!-- Modal  doctor-->
	<div class="modal fade" id="modal_doctor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar </h5>
				</div>
				<div class="modal-body">
					<form id="form_doctor">
						<div>
							<input type="hidden" name="id_doctor" id="id_doctor" value="">
							<label class="form-label">Cédula</label>
							<input class="form-control" type="text" name="cedula_doctor" id="cedula_doctor" >
						</div>
						<div>
							<label class="form-label">Código AS400</label>
							<input class="form-control" type="text" name="codigo_doctor" id="codigo_doctor" >
						</div>
						<div>

							<label class="form-label">Nombre</label>
							<input class="form-control" type="text" name="nombre_doctor" id="nombre_doctor">
						</div>
						<div>
							<label class="form-label">Apellido</label>
							<input class="form-control" type="text" name="apellido_doctor" id="apellido_doctor">
						</div>
						<div>
							<label class="form-label">Cargo</label>
							<select class="form-select" id="cargo_doctor" name="cargo_doctor">
								<option value="1">Administrador</option>
								<option value="2">Médico</option>
								<option value="3">Laboratorio</option>
							</select> 
						</div>	
						<div class="col text-center">	
							<button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Cancelar</button>			
							<button class="btn btn-primary my-3" id="btn_update_doctor">Actualizar</button>
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
			litar_doctores();
		 
			//listar doctores
			function litar_doctores(){

				$.ajax({
					url: '/iess/archivos_php/gestion_datos/consultar_doctor.php',
					type: 'GET',

					success: function(data) {
				  	//console.log(data);
				  	let lista_usuario = JSON.parse(data);
				  	let plantilla = '';

				  	lista_usuario.forEach(usuario=>{
				  		plantilla+=`

				  		<tr id_lista_usurios="${usuario.id_medico}">

				  		<td>${usuario.cedula}</td>
				  		<td>${usuario.codigo}</td>

				  		<td>${usuario.apellido}  ${usuario.nombre}</td>
				  		<td>${usuario.cargo}</td>
				  		<td> <button class="btn btn-info delete_doctor">Actualizar</button> </td>

				  		</tr>
				  		`;
				  	});
				  	$('#usuario_doctor').html(plantilla);
				  }



				});

			}

		 
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#buscar_doctor").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#usuario_doctor tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});

		});
	</script>

	<script type="text/javascript">
		//autocompletar formularios
	
		$(document).on('click','.delete_doctor',function(){
			let elemento = $(this)[0].parentElement.parentElement;
			let id=$(elemento).attr('id_lista_usurios');
			$.post('/iess/archivos_php/gestion_datos/consultar_doctor.php',{id},function(response){
				//console.log(response);
				$('#modal_doctor').modal('show');
				let lista_usuario = JSON.parse(response);
				$('#id_doctor').val(lista_usuario[0]['id_medico']);
				$('#cedula_doctor').val(lista_usuario[0]['cedula']);
				$('#codigo_doctor').val(lista_usuario[0]['codigo']);
				$('#nombre_doctor').val(lista_usuario[0]['nombre']);
				$('#apellido_doctor').val(lista_usuario[0]['apellido']);
				$('#cargo_doctor').val(lista_usuario[0]['cargo']);

			});

		});

		$(document).on('click', '.close_modal', function() {
			$('#modal_doctor').modal('hide');
		 
		});
	</script>

	<script type="text/javascript">
		//actualizar doctor
		

		$(document).on('click', '#btn_update_doctor', function(event) {
			event.preventDefault();
			let data_form = $('#form_doctor').serialize();
			$.post('/iess/archivos_php/gestion_datos/update_doctor.php', data_form, function(data) {

					succes_refresh(data,"/iess/vistas/gestion_datos/ver_medicos")
				
			});
		});




	</script>

</body>
</html>