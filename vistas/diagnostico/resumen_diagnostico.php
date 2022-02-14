<?php
session_start();
$usuario = $_SESSION['username'];
if (!isset($usuario)){
	header("location: ../../index.php");
}




?>


<?php 

if (isset($_SESSION['ss_id_paciente'])) {

	unset($_SESSION['ss_id_paciente']);
	unset($_SESSION['ss_paciente']);}

	if (isset($_SESSION['ss_id_diagnostico'])) {

		unset($_SESSION['ss_id_diagnostico']);
		unset($_SESSION['ss_diagnostico']);}

		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title></title>


			<meta name="viewport" content="width=device-width, initial-scale=1.0">

			<script type="text/javascript" src="/iess/js/jquery-3.6.0.min.js"></script>	
			<link rel="stylesheet" type="text/css" href="../../css/b_css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="../../css/menu.css">


		</head>
		<body style="zoom:80%">


			<?php
			include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/header.php");

			?>

			<div class="row">
				<?php
				include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar_diagnostico.php");
		//echo $navbar_diagnostico;
				$python = `python3 menu.py`;
				echo $python;  
				?>




				<!-- Formulario 1*****************************************-->
				<div class="col-9 	mt-1 shadow" style="width: 82%; height: 580px; overflow-y: scroll; " >

					<div class="col-5 pb-3 pt-0">
						<input type="text" id="buscar_admin" class="form-control rounded" placeholder="Buscar" aria-label="Search"	aria-describedby="search-addon" />
					</div>


					<?php 
				//include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/diagnostico/resumen.php");
					?>	

					<table class=" table table-bordered ">
						<thead>
							<tr>
								<th>DATOS PERSONALES</th>
								<th>DIAGNÓSTICO</th>
								<th>PRESCRIPCIÓN</th>
								<th>PEDIDO EXAMEN</th>
								<th>OPCIONES</th>


							</tr>
						</thead>

						<tbody id="usuario_admin" >


						</tbody> 
					</table>		
				</div>
				<!-- Formulario 1*****************************************-->




			</div>
			<?php 
			echo $footer;
			?>



			<!-- Modal -->
			<div class="modal fade" id="modal_pedido_examen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Solicitar Examen</h5>

						</div>
						<div class="modal-body">
							<form id="form_examen">		 
								<div>
									<input type="hidden" name="" id="id_diagnostico">
									<label class="form-label">Tipo de Examen</label>
									<select class="form-select" id="tipo_examen" name="tipo_examen">
										<option value="1">Sangre</option>
									</select> 
								</div>

								<div>
									<label class="form-label">Fecha</label>
									<input class="form-control" type="date" name="fecha" id="fecha" value="<?php 
									date_default_timezone_set('America/Guayaquil');
									echo date('Y-m-d'); ?>" disabled>
								</div>
								<div class="col text-center">

								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_salir">Cancelar</button>
							<button type="button" class="btn btn-primary" id="btn_crear">Solicitar</button>
						</div>
					</div>
				</div>
			</div>


			


			<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
			<script type="text/javascript" src="/iess/js/sweetalert2.all.min.js"></script>
			<script type="text/javascript" src="/iess/js/mensaje_general.js"></script>




			<script type="text/javascript">

				$(document).ready(function(){

					litar_usuarios();

					function litar_usuarios(){

						$.ajax({
							url: '/iess/archivos_php/diagnostico/resumen.php',
							type: 'GET',

							success: function(data) {
		  	//console.log(data);
		  	let lista_general = JSON.parse(data);
		  	let plantilla = '';

		  	lista_general.forEach(usuario=>{

		  		plantilla+=`

		  		<tr id_lista_usurios="${usuario.id_diagnostico}-${usuario.id_prescripcion}" >

		  		<td >
		  		${usuario.nombre_paciente}

		  		</td>

		  		<td>

		  		
		  		<strong>Id_enf1:</strong> ${usuario.id_enfermedad1}
		  		<br>
		  		<strong>Enfermedad 1:</strong> ${usuario.nombre_enfermedad1}
		  		<br>
		  		<strong>Id_enf2:</strong> ${usuario.id_enfermedad2}
		  		<br>
		  		<strong>Enfermedad 2(opcional):</strong> ${usuario.nombre_enfermedad2}
		  		<br>
		  		<strong>Fecha:</strong> ${usuario.fecha_diagnostico}
		  		<br>
		  		<strong>Comentario:</strong> ${usuario.diagnostico}
		  		


		  		</td>	
		  		`;


		  		if (usuario.id_antibiotico==null) {
		  			plantilla+=`<td></td>`
		  		}else {
		  			plantilla+=`
		  			<td>
		  			<strong>Id_antbiótico:</strong> ${usuario.id_antibiotico}
		  			<br>
		  			<strong>Antibiótico:</strong> ${usuario.antibiotico}
		  			<br>
		  			<strong>Dosis:</strong> ${usuario.dosis}
		  			<br>
		  			<strong>Escala:</strong> ${usuario.escala}
		  			<br>
		  			<strong>Desescala:</strong> ${usuario.desescala}
		  			<br>
		  			<strong>Mantiene:</strong> ${usuario.mantiene}
		  			<br>
		  			<strong>Ajuste dosis:</strong> ${usuario.ajuste_dosis}
		  			<br>
		  			<strong>Fe_inicio:</strong> ${usuario.inicio}
		  			<br>
		  			<strong>Tiempo(días):</strong> ${usuario.tiempo}
		  			<br>
		  			<strong>Fe_fin:</strong> ${usuario.fin}
		  			

		  			</td>`;
		  		}


		  		if (usuario.tipo_examen==null) {
		  			plantilla+=`<td></td>`
		  		}else {
		  			plantilla+=`
		  			<td>
		  			<strong>Tipo:</strong>${usuario.tipo_examen}
		  			<br>
		  			<strong>Fecha: </strong>${usuario.fecha_pedido}
		  			</td>`;
		  		}


		  		if (usuario.id_antibiotico==null) {
		  			plantilla+=`

		  			<td> 
		  			<form method="post" action="/iess/vistas/diagnostico/prescripcion_medica">
		  			<input type="hidden" name="id_diag" value="${usuario.id_diagnostico}">
		  			<input type="hidden" name="diag" value="${usuario.nombre_enfermedad1}, ${usuario.nombre_enfermedad2}">
		  			<input type="hidden" name="id_pa" value="${usuario.id_paciente}">
		  			<input type="hidden" name="pa" value="${usuario.nombre_paciente}">

		  			<button class="btn btn-info btn_crear_prescripcion my-1">Crear Prescrición</button>	
		  			</form>
		  			</td>`
		  		}
		  		if (usuario.id_antibiotico!=null &&  usuario.tipo_examen==null) {
		  			plantilla+=`


		  			<td> 
		  			<form method="post" action="/iess/vistas/diagnostico/prescripcion_medica">
		  			<input type="hidden" name="id_diag" value="${usuario.id_diagnostico}">
		  			<input type="hidden" name="diag" value="${usuario.nombre_enfermedad1}, ${usuario.nombre_enfermedad2}">
		  			<input type="hidden" name="id_pa" value="${usuario.id_paciente}">
		  			<input type="hidden" name="pa" value="${usuario.nombre_paciente}">
		  			<button class="btn btn-info btn_crear_prescripcion my-1">Nueva prescrición</button>	
		  			</form>	
		  			<br>
		  			<button class="btn btn-info btn_pedir_examen my-1">Pedir Examen</button>	
		  			</td>`
		  		}

		  		if (usuario.id_antibiotico!=null &&  usuario.tipo_examen!=null) {
		  			plantilla+=`


		  			<td> 
		  			<form method="post" action="/iess/vistas/diagnostico/prescripcion_medica">
		  			<input type="hidden" name="id_diag" value="${usuario.id_diagnostico}">
		  			<input type="hidden" name="diag" value="${usuario.nombre_enfermedad1}, ${usuario.nombre_enfermedad2}">
		  			<input type="hidden" name="id_pa" value="${usuario.id_paciente}">
		  			<input type="hidden" name="pa" value="${usuario.nombre_paciente}">

		  			<button class="btn btn-info btn_crear_prescripcion my-1">Nueva Prescrición</button>	
		  			</form>	

		  			</td>`
		  		}







		  		plantilla+=`</tr>`;

		  	});
		  	$('#usuario_admin').html(plantilla);
		  }

		});

					}






				});

			</script>



			<script type="text/javascript">
				$(document).ready(function(){

					$(document).on('click','.btn_pedir_examen',function(){
						let elemento = $(this)[0].parentElement.parentElement;
						let id=$(elemento).attr('id_lista_usurios');
						$('#id_diagnostico').val(id);
						$('#modal_pedido_examen').modal('show');


					});

					$(document).on('click','#btn_salir',function(){
						$('#modal_pedido_examen').modal('hide');

					});
				});


			</script>


			<script type="text/javascript">

				$(document).on('click','#btn_crear',function(){


					var data_form={
						id_diagnostico:$('#id_diagnostico').val(),
						id_tipo_examen:$('#tipo_examen').val()
					}

					console.log(data_form)
					$.post('/iess/archivos_php/diagnostico/ingresar_examn.php', data_form, function(data) {
						console.log(data)
						if (data=="ok") {
							$('#modal_pedido_examen').modal('hide');
							succes_refresh("Datos Guardados",'/iess/vistas/diagnostico/resumen_diagnostico');
							//succes_message("Datos Guardados");
							
						}
					});


				});




			</script>


			<script type="text/javascript">
				
				$("#buscar_admin").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#usuario_admin tr").filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});


			</script>






		</body>
		</html>