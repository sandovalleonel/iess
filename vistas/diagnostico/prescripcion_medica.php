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
	<title></title>
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
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar_diagnostico.php");
		//echo $navbar_diagnostico;
		$python = `python3 menu.py`;
		echo $python;  
		?>

		<?php
		echo "<input type='hidden' id='medico' value='".$_SESSION['username']."' >";
			if (isset($_SESSION['ss_id_paciente'])) {
				echo "<input type='hidden' id='id_paciente' value='".$_SESSION['ss_id_paciente']."' >";
				
				$temp_paciente = $_SESSION['ss_paciente'];
			}
			if (isset($_SESSION['ss_id_diagnostico'])) {
				echo "<input type='hidden' id='id_diagnostico' value='".$_SESSION['ss_id_diagnostico']."' >";
				$temp_diagnostico = $_SESSION['ss_diagnostico'];
			}
			?>

			<?php
			 
				if (isset($_POST['id_diag'])) {
				 
					echo "<input type='hidden' id='id_paciente' value='".$_POST['id_pa']."' >";
					echo "<input type='hidden' id='id_diagnostico' value='".$_POST['id_diag']."' >";
					$temp_paciente = $_POST['pa'];
					$temp_diagnostico = $_POST['diag'];
				} 
			?>


		<div class="col-1">	</div>
		<!-- Formulario 1*****************************************-->
		<div class="col-xs-12 col-md-6  mt-5 shadow"  >




			<h6 class="text-center pt-3">FORMULARIO PRESCRIPCIÓN MÉDICA</h6>


			<form action="" id="fomr_prescripcio">
				<div class="row">
					
					<div class="col">
						<label class="form-label">Paciente</label>
						<input type="text" class="form-control" id="diagnostico_nombre_paciente" name="diagnostico_nombre_paciente"  disabled 
						value="<?php if (isset($temp_paciente)) echo $temp_paciente; ?>
						">
						
					</div>

					<div class="col-12">
						<label class="form-label">Diagnóstico</label>
						<textarea class="form-control mb-3" id="diagnostico" rows="3" disabled > <?php if (isset($temp_diagnostico)) echo $temp_diagnostico;  ?>

						</textarea>
						 
					</div>
					<hr>
					<h6>Nuva Prescripción</h6>
					<div class="col-4">
						<label class="form-label">Antibiotico</label>
						<select class="form-select" id="antibiotico" name="antibiotico">
							 

						</select>
					</div>
					 

					<div class="col-3">
						<label class="form-label">Dosis</label>
						<input type="text" class="form-control" name="dosis" id="dosis" value="0">
					</div>
					<div class="col-2">
						<label class="form-label">U</label>
						<select class="form-select" id="desc_dosis">
							<option>Unidad Gramos</option>
							<option>Unidad miligramos</option>
							<option>Unidad UI</option>
							<option>Vía de administración Endovenosa</option>
							<option>Vía de administración Intramuscular</option>
							<option>Vía de administración Oral</option>
							<option>Vía de administración subcutánea</option>
							<option>Método de infusión Infusión continua</option>
							<option>Método de infusión Dosis de carga</option>
							<option>Método de infusión Ninguna</option>
							<option>Método de infusión Las dos</option>
						</select>
					</div>


					<hr>
					<div class="col-4">
						<label class="form-label">Fecha de Registro</label>
						<input disabled type="date" class="form-control"  id="inicio"> </div>
				<div class="col-4">
					<label class="form-label">Tiempo (días)</label>
					<input type="number" class="form-control" name="tiempo" id="tiempo" min="0" value="0">
				</div>
				<div class="col-4">
					<label class="form-label">Fecha de fin de tratamiento</label>
					<input disabled type="date" class="form-control" name="fin" id="fin">
				</div>

				<hr>
 


				<div class="col-4">
					<label class="form-label">Escala</label>
					<select class="form-select" id="escala" name="escala">
						<option>SI</option>
						<option>NO</option>
					</select>
				</div>
				<div class="col-4">
					<label class="form-label">Mantien</label>
					<select class="form-select" id="mantiene" name="mantiene">
						<option>SI</option>
						<option>NO</option>
					</select>
				</div>
				<div class="col-4">
					<label class="form-label">Descala</label>
					<select class="form-select" id="descala" name="descala">
						<option>SI</option>
						<option>NO</option>
					</select>
				</div>
				<div class="col-4">
					<label class="form-label">Ajuste de Dosis</label>
					<select class="form-select" id="ajuste_dosis" name="ajuste_dosis">
						<option>SI</option>
						<option>NO</option>
					</select>
				</div>
 


			</div>
			<div class="col text-center">
			<button class="btn btn-primary my-3" id="btn_guardar">Guardar</button>
		 
		</div>
		</form>

	</div>
	<!-- Formulario 1*****************************************-->


</div>
<?php 
	echo $footer;
	?>


<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
<script type="text/javascript" src="/iess/js/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="/iess/js/mensaje_general.js"></script>
<script type="text/javascript" src="/iess/js/jquery.validate.min.js"></script>


<script type="text/javascript">
	//listar antibiotico
	$(document).ready(function(){
		listar_antibiotico();

		function listar_antibiotico(){
			$.ajax({
				url: '/iess/archivos_php/diagnostico/cargar_antibiotico.php',
				type: 'GET',

				success: function(data) {
					
					let lista = JSON.parse(data);
					let plantilla = '';

					lista.forEach(antibiotico=>{
						plantilla+=`

						<option value= "${antibiotico.id_antibiotico}">${antibiotico.antibiotico}</option>

						`;
					});
					$('#antibiotico').append(plantilla);
				}



			});
		}

	});
</script>


<script type="text/javascript">
	//insertar prescripcion
	//validar no vacio
 


	$(document).on('click','#btn_guardar',function(e){
		e.preventDefault();
		ingresar_prescripcion("/iess/archivos_php/diagnostico/ingresar_prescripcion.php","Prescripcion Creada");

	});

	function ingresar_prescripcion(url_ingresar, mensaje){
 
		if (!$("#id_paciente").length) {
			erro_message("Error seleccione un paciente");
			return;
		}
		if (!$('#id_diagnostico').length) {
			erro_message("Error el paciente no tiene diagnóstico");
			return;
		}
		let aux_dosis = $('#dosis').val()+" "+$('#desc_dosis').val();

		const data_form={
			id_diag:$('#id_diagnostico').val().trim(),
			id_antibiotico:$('#antibiotico').val(),
			at24:"",
			 
			medico_responsable:$('#medico').val(),
			dosis:aux_dosis,
			tiempo:$('#tiempo').val(),
			escala:$('#escala').val(),
			mantiene:$('#mantiene').val(),
			descala:$('#descala').val(),
			ajuste_dosis:$('#ajuste_dosis').val(),


		};
		$.post(url_ingresar,data_form,function(response){

			if (response=='ok') {
				succes_refresh(mensaje,'/iess/vistas/diagnostico/resumen_diagnostico');
			}else{
				erro_message("Error de ingreso");
				console.log(response);
			}


		});
	}
</script>

 


<script type="text/javascript">
	mostrar_alertas();
	function mostrar_alertas(){
			//id_alertas_navbar
			$.ajax({
				url: '/iess/archivos_php/notificaciones/total_notificaciones.php',
				type: 'GET',
				success: function(data) {

					if (data>0) {
						$('#id_alertas_navbar').text('Alertas ('+data+')');
					}
				}
			});
		}
	</script>



<script type="text/javascript">
	//visualizar fechas

	$(document).ready(function() {

		$('#tiempo').on("input", function() {
    	let dias = this.value;
    	dias = parseInt(dias);
    	let f = new Date();
		let fecha_actual = obtener_fecha_final(f);
 

    	let fecha_sumada = obtener_fecha_final( sumar_fechas(dias) );
    	//console.log(sumar_fechas(dias));
		$('#fin').val(fecha_sumada);

	   	});

		//mostrar fecha inicial
		let f = new Date();
		let fecha_actual = obtener_fecha_final(f);
		$('#inicio').val(fecha_actual)


		function obtener_fecha_final(now){
	 	let day = ("0" + now.getDate()).slice(-2);
		let month = ("0" + (now.getMonth() + 1)).slice(-2);
		let today = now.getFullYear()+"-"+(month)+"-"+(day) ;
		return today;
	 }

	 function sumar_fechas(dias){
	 	let fecha = new Date();
		fecha.setDate(fecha.getDate() + dias);
		return fecha;

	 }
	});
</script>



</body>
</html>