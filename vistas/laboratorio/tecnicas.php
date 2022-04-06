<?php
session_start();
$usuario = $_SESSION['username'];
if (!isset($usuario)){
	header("location: ../../index.php");
}

date_default_timezone_set('America/Guayaquil');


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Técnicas</title>
	<link rel="icon" href="../../imagenes/favicon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../css/b_css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/menu.css">
</head>
<body>
	

	<?php
	include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/header.php");

	?>

	<div class="row">
		<?php
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar.php");
		//echo $navbar_laboratorio; 
		include("menu.php");
		?>




		<?php 
			if (isset($_POST['id_tincion'])) {

				$id_tincion = $_POST['id_tincion'];
				$paciente = $_POST['paciente'];
			 

			}
		?>

		<div class="col-1">	</div>
		<!-- div*****************************************-->
		<div class="col-xs-12 col-md-6  mt-5 shadow"  >
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="tecnica1-tab" data-bs-toggle="tab" data-bs-target="#tecnica1" type="button" role="tab" aria-controls="tecnica1" aria-selected="true">Biología Molecular Film Array</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="tecnica2-tab" data-bs-toggle="tab" data-bs-target="#tecnica2" type="button" role="tab" aria-controls="tecnica2" aria-selected="false">Antibiograma</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="tecnica3-tab" data-bs-toggle="tab" data-bs-target="#tecnica3" type="button" role="tab" aria-controls="tecnica3" aria-selected="false">Biología Molecular Eplex</button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="tecnica1" role="tabpanel" aria-labelledby="tecnica1-tab">

					<!-- tec1*+++++++++++++++++++++++++++++++-->


					<hr>
					<div class="container ">
						<form id="form_t1" >

							<div class="form-group col-3 d-inline-block">
								<label for="exampleInputEmail1">Id Tinción</label>
								<input type="text" class="form-control" disabled value="<?php 
								if(isset($id_tincion))
								echo $id_tincion;
							?>" >
						</div>
						<div class="form-group col-8 d-inline-block">
							<label for="exampleInputEmail1"> Paciente</label>
							<input type="text" class="form-control" disabled value="<?php 

							if(isset($paciente))
							echo $paciente; ?>" >
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1"> Bacteria</label>
							<select class="form-select" id="t1_tipo_id">
								<?php
									include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/laboratorio/cargar_bacteria.php");

								?>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Gen Resistencia</label>
							<select class="form-select" id="t1_gen_resistencia">
								<option>NINGUNO</option>
								<option>NO APLICA</option>
								<option>CTX-M</option>
								<option>KPC</option>
								<option>NDM</option>
								<option>MecA/C</option>
								<option>MecA/C - MREJ</option>
								<option>Oxa-48</option>
								<option>mcr-1</option>
								<option>VanA</option>
								<option>VanB</option>
								<option>VIM</option>
								<option>IMP</option>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Fecha </label>
							<input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1">Observación</label>
							<input type="text" class="form-control" id="t1_observacion">
						</div>
						<div class="col text-center">
						<input type='button' value='Guardar' id='btn_bmf' class="btn btn-primary my-3">

						<input type='button' value='Salir'  class="btn btn-danger my-3 btn_salir" onclick="verificar_salir()">
						
						 
					</div>
					</form>

				</div>

				<!-- tec1*+++++++++++++++++++++++++++++++-->
			</div>
			<div class="tab-pane fade" id="tecnica2" role="tabpanel" aria-labelledby="tecnica2-tab">
				<!-- tec2*+++++++++++++++++++++++++++++++-->

				<hr>
				<div class="container ">

					<form   id="form_t2">
						<div class="form-group col-3 d-inline-block">
							<label for="exampleInputEmail1">Id Tinción</label>
							<input type="text" class="form-control" disabled value="<?php 
							if(isset($id_tincion))
							echo $id_tincion;
						?>" id="id_tincion">
					</div>
					<div class="form-group col-8 d-inline-block">
						<label for="exampleInputEmail1"> Paciente</label>
						<input type="text" class="form-control" disabled value="<?php 

						if(isset($paciente))
						echo $paciente; ?>" >
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1"> Bacteria</label>
						<select class="form-select" id="t2_tipo_id">
							<?php
									include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/laboratorio/cargar_bacteria.php");

								?>
						</select>
						
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Fenotipo</label>
						<select class="form-select" id="t2_fenotipo">
							<option>NINGUNO</option>
							<option>NO APLICA</option>
							<option> BLEE </option>
							<option> AmpC </option>
							<option> Carbapenemasa no identificada </option>
							<option> Carbapenemasa KPC </option>
							<option> Carbapenemasa VIM </option>
							<option> Carbapenemasa IMP </option>
							<option> Carbapenemasa NDM </option>
							<option> Carbapenemasa OXa-48 like </option>
							<option> Resistencia a los carbapenémicos no enzimático </option>
							<option> Resistencia a la colistina </option>
							<option> Resistencia a la oxacilina </option>
							<option> Resistencia a la clindamicina </option>
							<option> Resistencia a la Vancomicina </option>
							<option> Resistencia a la gentamicina de alta carga </option>

						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Fecha </label>
						<input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Reporte Acorde a Guia</label>
						<select class="form-select" id="t2_reporte_acorde_guia">
							<option>NO</option>
							<option>SI</option>
							
						</select>
					</div>



					<div class="form-group">
						<label for="exampleInputEmail1">Observación</label>
						<input type="text" class="form-control" id="t2_observacion">
					</div>
					<div class="col text-center">
						<input type='button' value='Guardar' id='btn_antibiograma' class="btn btn-primary my-3">
						<input type='button' value='Salir'  class="btn btn-danger my-3 btn_salir" onclick="verificar_salir()">
					
					
				</div>
				</form>	
			</div>
			<!-- tec2*+++++++++++++++++++++++++++++++-->
		</div>
		<div class="tab-pane fade" id="tecnica3" role="tabpanel" aria-labelledby="tecnica3-tab">
			<!-- tec3*+++++++++++++++++++++++++++++++-->

			<hr>
			<div class="container ">

				<form id="form_t3" >

					<div class="form-group col-3 d-inline-block">
						<label for="exampleInputEmail1">Id Tinción</label>
						<input type="text" class="form-control" disabled value="<?php 
						if(isset($id_tincion))
						echo $id_tincion;
					?>" id="id_tincion">
				</div>
				<div class="form-group col-8 d-inline-block">
					<label for="exampleInputEmail1"> Paciente</label>
					<input type="text" class="form-control" disabled value="<?php 

					if(isset($paciente))
					echo $paciente; ?>" >
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Bacteria</label>
					<select class="form-select" id="t3_tipo_id">
						<?php
									include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/laboratorio/cargar_bacteria.php");

								?>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Mec Resistencia</label>
					<select class="form-select" id="t3_mec_resistencia">
						<option>NINGUNO</option>
						<option>NO APLICA</option>
						<option>CTX-M</option>
						<option>KPC</option>
						<option>NDM</option>
						<option>MecA/C</option>
						<option>MecA/C - MREJ</option>
						<option>Oxa-48</option>
						<option>mcr-1</option>
						<option>VanA</option>
						<option>VanB</option>
						<option>VIM</option>
						<option>IMP</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Fecha </label>
					<input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Observación</label>
					<input type="text" class="form-control" id="t3_observacion">
				</div>
				<div class="col text-center">
				<input type='button' value='Guardar' id='btn_bme' class="btn btn-primary my-3">
				<input type='button' value='Salir'  class="btn btn-danger my-3 btn_salir" onclick="verificar_salir()">
				<!--<a href="/iess/vistas/laboratorio/ver_pacientes" class="btn btn-danger" onclick="verificar_salir()">Finalizar y Salir</a>-->
				 
				
			</div>
			</form>
		</div>
		<!-- tec3*+++++++++++++++++++++++++++++++-->
	</div>

		
</div> 

</div>
<!-- div*****************************************-->





</div>
<?php 
echo $footer;
?>

<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="../../js/mensaje_general.js"></script>


 


<script type="text/javascript">
		//validar campo paciente y tincion
		function validar_datos(){
			var estado = true;
			$tincion = $('#id_tincion').val();
			$paciente = $('#paciente').val();
			if ($paciente=="") {
				erro_message("Error, seleccione un paciente en la sección mis pacientes");
				estado=false;
			}
			if ($tincion=="") {
				erro_message("Error, seleccione un paciente en la sección mis pacientes");
				estado=false;
			}
			return estado;

		}
</script>



	<script type="text/javascript">
		//ingresar tecnica array
		$(document).on('click', '#btn_bmf', function(event) {
			event.preventDefault();
			if(validar_datos()){
				ingresar_tecnica_bmf()
			}

		});


		function ingresar_tecnica_bmf(){
			var data_form ={
				id_gram:$('#id_tincion').val(),
				id_bacteria:$('#t1_tipo_id').val(),
				gen_resistencia:$('#t1_gen_resistencia').val(),
				comentario:$('#t1_observacion').val(),
				
			};
			 
			$.post('../../archivos_php/laboratorio/ingresar_tecnica_bmf.php', data_form, function(data) {
				console.log(data)
				 
				if (data=="ok") {
					succes_message("Creado correctamente");
					$('#form_t1 input').attr('disabled', 'disabled');
					$('#form_t1 select').attr('disabled', 'disabled');
					$("#btn_bmf").attr("disabled",true);
					$("#btn_bmf").attr('value', 'Guardado');
					$(".btn_salir").attr("disabled",false);

				}else if (data=="existe") {
					erro_message("El examen ya tiene registrada esta técnica");
					$('#form_t1 input').attr('disabled', 'disabled');
					$('#form_t1 select').attr('disabled', 'disabled');
					$("#btn_bmf").attr("disabled",true);
					$("#btn_bmf").attr('value', 'Guardado');
					$(".btn_salir").attr("disabled",false);
				}


				else{
					erro_message("Error al ingresar");
				}
			});
		}
	</script>


	<script type="text/javascript">

		$(document).on('click', '#btn_antibiograma', function(event) {
			event.preventDefault();
			if(validar_datos()){
				ingresar_tecnica_antibiograma()
			}

		});
		//ingresar antibiograma
		function ingresar_tecnica_antibiograma(){
			var data_form ={
				id_gram:$('#id_tincion').val(),
				id_bacteria:$('#t2_tipo_id').val(),
				fenotipo:$('#t2_fenotipo').val(),
				reporte_guia:$('#t2_reporte_acorde_guia').val(),
				observacion:$('#t2_observacion').val(),
				
			};
			 
			$.post('../../archivos_php/laboratorio/ingresar_tecnica_antibiograma.php', data_form, function(data) {
				
				if (data=="ok") {
					succes_message("Creado correctamente");
					$('#form_t2 input').attr('disabled', 'disabled');
					$('#form_t2 select').attr('disabled', 'disabled');
					$("#btn_antibiograma").attr("disabled",true);
					$("#btn_antibiograma").attr('value', 'Guardado');
					$(".btn_salir").attr("disabled",false);
					

				}else if (data=="existe") {
					erro_message("El examen ya tiene registrada esta técnica");
					$('#form_t2 input').attr('disabled', 'disabled');
					$('#form_t2 select').attr('disabled', 'disabled');
					$("#btn_antibiograma").attr("disabled",true);
					$("#btn_antibiograma").attr('value', 'Guardado');
					$(".btn_salir").attr("disabled",false);
					
				}else{
					erro_message("Error al ingresar");
				}
			});
		}

	</script>



		<script type="text/javascript">

		$(document).on('click', '#btn_bme', function(event) {
			event.preventDefault();
			if(validar_datos()){
				ingresar_tecnica_eplex()
			}

		});
		//ingresar eplex
		function ingresar_tecnica_eplex(){
			var data_form ={
				id_gram:$('#id_tincion').val(),
				id_bacteria:$('#t3_tipo_id').val(),
				mec_resistencia:$('#t3_mec_resistencia').val(),
				observacion:$('#t3_observacion').val(),
				
				
			};
			 
			$.post('../../archivos_php/laboratorio/ingresar_tecnica_bme.php', data_form, function(data) {
				console.log(data)
				
				if (data=="ok") {
					succes_message("Creado correctamente");
					$('#form_t3 input').attr('disabled', 'disabled');
					$('#form_t3 select').attr('disabled', 'disabled');
					$("#btn_bme").attr("disabled",true);
					$("#btn_bme").attr('value', 'Guardado');
					$(".btn_salir").attr("disabled",false);
					

				}else if (data=="existe") {
					erro_message("El examen ya tiene registrada esta técnica");
					$('#form_t3 input').attr('disabled', 'disabled');
					$('#form_t3 select').attr('disabled', 'disabled');
					$("#btn_bme").attr("disabled",true);
					$("#btn_bme").attr('value', 'Guardado');
					$(".btn_salir").attr("disabled",false);
					
				}else{
					erro_message("Error al ingresar");
				}
			});
		}

	</script>


	<script type="text/javascript">
		
		function verificar_salir(){
			Swal.fire({
			title: 'Está seguro?',
			text: "Finalizar y volver al menú principal?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#9b9b9b',
			confirmButtonText: 'Si ',
			cancelButtonText: 'Cancelar'

		}).then((result) => {
			if (result.isConfirmed) {
				location.href ="../../vistas/laboratorio/ver_pacientes";
				
			}
		})
		}
	</script>

	
</body>
</html>