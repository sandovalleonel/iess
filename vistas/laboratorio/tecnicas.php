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
	<title></title>
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
		$python = `python3 menu.py`;
		echo $python; 
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
								<label for="exampleInputEmail1">Id Tincion</label>
								<input type="text" class="form-control" disabled value="<?php 
								if(isset($_SESSION['l_s_id_tincion']))
								echo $_SESSION['l_s_id_tincion'];
							?>" id="id_tincion">
						</div>
						<div class="form-group col-8 d-inline-block">
							<label for="exampleInputEmail1"> Paciente</label>
							<input type="text" class="form-control" disabled value="<?php 

							if(isset($_SESSION['l_s_paciente']))
							echo $_SESSION['l_s_paciente']; ?>" id="paciente">
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1">Estado</label>
							<select class="form-select" id="t1_tipo_id">

							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Gen Resistencia</label>
							<select class="form-select" id="t1_gen_resistencia">
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
						<!--<button type="submit" class="btn btn-primary my-3" id="btn_bmf">Guardar</button>-->
						<button type="submit" class="btn btn-danger my-3 btn_terminar" id="">Finalizar</button>
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
							<label for="exampleInputEmail1">Id Tincion</label>
							<input type="text" class="form-control" disabled value="<?php 
							if(isset($_SESSION['l_s_id_tincion']))
							echo $_SESSION['l_s_id_tincion'];
						?>" id="id_tincion">
					</div>
					<div class="form-group col-8 d-inline-block">
						<label for="exampleInputEmail1"> Paciente</label>
						<input type="text" class="form-control" disabled value="<?php 

						if(isset($_SESSION['l_s_paciente']))
						echo $_SESSION['l_s_paciente']; ?>" id="paciente">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Identificacion Bacteria</label>
						<select class="form-select" id="t2_tipo_id">
							
						</select>
						
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Fenotipo</label>
						<select class="form-select" id="t2_fenotipo">
							<option> Ninguno </option>
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
							<option>SI</option>
							<option>NO</option>
						</select>
					</div>



					<div class="form-group">
						<label for="exampleInputEmail1">Observación</label>
						<input type="text" class="form-control" id="t2_observacion">
					</div>
					<div class="col text-center">
					<button type="submit" class="btn btn-primary my-3" id="btn_antibiograma">Guardar</button>
					<button type="submit" class="btn btn-danger my-3 btn_terminar " id="">Finalizar</button>
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
						<label for="exampleInputEmail1">Id Tincion</label>
						<input type="text" class="form-control" disabled value="<?php 
						if(isset($_SESSION['l_s_id_tincion']))
						echo $_SESSION['l_s_id_tincion'];
					?>" id="id_tincion">
				</div>
				<div class="form-group col-8 d-inline-block">
					<label for="exampleInputEmail1"> Paciente</label>
					<input type="text" class="form-control" disabled value="<?php 

					if(isset($_SESSION['l_s_paciente']))
					echo $_SESSION['l_s_paciente']; ?>" id="paciente">
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Estado</label>
					<select class="form-select" id="t3_tipo_id">

					</select>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Mec Resistencia</label>
					<select class="form-select" id="t3_mec_resistencia">
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
				<!--<button type="submit" class="btn btn-primary my-3" id="btn_bmf">Guardar</button>-->
				<button type="submit" class="btn btn-danger my-3 btn_terminar" id="">Finalizar</button>
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
<script type="text/javascript" src="/iess/js/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="/iess/js/mensaje_general.js"></script>

<script type="text/javascript">
	$(document).on('click', '.btn_terminar', function(event) {
		$.post('/iess/archivos_php/laboratorio/terminar_tecnicas.php', {param1: 'value1'}, function(data) {
			$(location).attr('href', '/iess/vistas/laboratorio/ver_pacientes')
		});
	});
</script>
<script type="text/javascript">
		//validar campo paciente y tincion
		function validar_datos(){
			var estado = true;
			$tincion = $('#id_tincion').val();
			$paciente = $('#paciente').val();
			if ($paciente=="") {
				erro_message("Error, seleccione paciente");
				estado=false;
			}
			if ($tincion=="") {
				erro_message("El paciente no tiene tincion");
				estado=false;
			}
			return estado;

		}
</script>

	<script type="text/javascript">
		//cargar 3 combos
		cargar_combo(1,"t1_tipo_id");
		cargar_combo(2,"t2_tipo_id");
		cargar_combo(3,"t3_tipo_id");
		function cargar_combo(id,nombre_combo){
			$.post('/iess/archivos_php/laboratorio/cargar_tres_combos_tecnicas.php', {id_opcion: id}, function(data) {

				let lista = JSON.parse(data);
				let plantilla = '';

				lista.forEach(usuario=>{
					plantilla+=`<option value="${usuario.id_estado}">${usuario.estado}</option>`;
				});
				$('#'+nombre_combo).empty();
				$('#'+nombre_combo).append(plantilla);

			});	

		}
	</script>

	<script type="text/javascript">
		//ingresar tecnica bmf
		$(document).on('click', '#btn_bmf', function(event) {
			event.preventDefault();
			if(validar_datos()){
				ingresar_tecnica_bmf()
			}

		});


		function ingresar_tecnica_bmf(){
			var data_form ={
				id_gram:$('#id_tincion').val(),
				observacion:$('#t1_observacion').val(),
				id_estado:$('#t1_tipo_id').val(),
				gen_resistencia:$('#t1_gen_resistencia').val()
			};
			console.log(data_form);
			$.post('/iess/archivos_php/laboratorio/ingresar_tecnica_bmf.php', data_form, function(data) {
				console.log(data);
				if (data=="ok") {
					succes_message("Creado correctamente");
					$('#form_t1 input').attr('disabled', 'disabled');
					$("#btn_bmf").attr("disabled",true);
					$("#btn_bmf").attr('value', 'Guardado');

				}else{
					erro_message("Error al ingresar");
				}
			});
		}
	</script>

	<script type="text/javascript">
		//ingresar bme
		$(document).on('click', '#btn_bme', function(event) {
			event.preventDefault();
			if(validar_datos()){
				ingresar_tecnica_bme()
			}

		});


		function ingresar_tecnica_bme(){
			var data_form ={
				id_gram:$('#id_tincion').val(),
				observacion:$('#t3_observacion').val(),
				id_estado:$('#t3_tipo_id').val(),
				gen_resistencia:$('#t3_mec_resistencia').val()
			};
			console.log(data_form);
			$.post('/iess/archivos_php/laboratorio/ingresar_tecnica_bme.php', data_form, function(data) {
				console.log(data);
				if (data=="ok") {
					succes_message("Creado correctamente");
					$('#form_t3 input').attr('disabled', 'disabled');
					$("#btn_bme").attr("disabled",true);
					$("#btn_bme").attr('value', 'Guardado');

				}else{
					erro_message("Error al ingresar");
				}
			});
		}
	</script>


	<script type="text/javascript">
		//ingresar antibiograma
		$(document).on('click', '#btn_antibiograma', function(event) {
			event.preventDefault();
			if(validar_datos()){
				ingresar_tecnica_antibiograma()
			}

		});


		function ingresar_tecnica_antibiograma(){
			var data_form ={
				id_gram:$('#id_tincion').val(),
				observacion:$('#t2_observacion').val(),
				id_estado:$('#t2_tipo_id').val(),
				fenotipo:$('#t2_fenotipo').val(),
				reporte_guia:$('#t2_reporte_acorde_guia').val()
			};
			console.log(data_form);
			$.post('/iess/archivos_php/laboratorio/ingresar_tecnica_antibiograma.php', data_form, function(data) {
				console.log(data);
				if (data=="ok") {
					succes_message("Creado correctamente");
					$('#form_t2 input').attr('disabled', 'disabled');
					$("#btn_antibiograma").attr("disabled",true);
					$("#btn_antibiograma").attr('value', 'Guardado');

				}else{
					erro_message("Error al ingresar");
				}
			});
		}
	</script>
</body>
</html>