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

		<div class="col-1">	</div>
		<!-- Formulario 1*****************************************-->

		<div class="col-xs-12 col-md-6  mt-5 shadow"  >

			
			<div class="shadow p-2">
				<div class="col-6  d-inline-block">
					<form id="form_buscar_paciente">
						
						<input class="form-control d-inline-block" style="width: 70%;" type="text" name="buscar_paciente" id="buscar_paciente">
						<button class="btn btn-primary" id="diagnostico_cargar_combo" name="diagnostico_cargar_combo">Buscar</button>
					</form>
				</div>
				<div class="col-5  d-inline-block">
					<select class="form-select" style="background: #CECAC9;" name="diagnostico_paciente" id="diagnostico_paciente">
					</select>
				</div>
			</div>

			<?php
			if (isset($_SESSION['ss_id_paciente'])) {
				echo "<button class='btn btn-primary' name='s_paciente' id='s_paciente'> Continuar con el ".$_SESSION['ss_paciente']."</button>";

				echo "<input type='hidden' id='s_id_paciente' value='".$_SESSION['ss_id_paciente']."' >";
				echo "<input type='hidden' id='s_nom_paciente' value='".$_SESSION['ss_paciente']."' >";
			}
			?>


			<h6 class="text-center">Formulario Pedido Examen</h6>

			<div class="container ">
				<form id="form_examen">
					<div>

						<label class="form-label">Diagnóstico</label>
						<input class="form-control" type="text" name="diag" id="diag" value="" disabled>
						<input class="form-control" type="hidden" name="id_diag" id="id_diag">
					</div>
					<div>

						<label class="form-label">Paciente</label>
						<input class="form-control" type="text" name="paciente" id="paciente" disabled="" />
					</div>

					<div>
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
					<button class="btn btn-primary my-3" id="btn_guardar" name="btn_guardar">Crear</button>
				</div>
				</form>
			</div>
		</div>
		<!-- Formulario 1*****************************************-->





	</div>
	<?php 
	echo $footer;
	?>


	<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/iess/js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="/iess/js/sweetalert2.all.min.js"></script>
	<script type="text/javascript" src="/iess/js/mensaje_general.js"></script>

	<script type="text/javascript">


		$(document).on('click','#btn_guardar',function(e){ 
			e.preventDefault();
			if ($('#paciente').val()=='') {
				erro_message("Error seleccione un paciente");
				return;
			}
			if ($('#diag').val()=='') {
				erro_message("Error el paciente no tiene diagnóstico");
				return;
			}
			

			
			guardar_pedido_examen();			
		});


		function guardar_pedido_examen(){
			let data_form = {
				id_diag:$('#id_diag').val(),
				fecha:$('#fecha').val(),
				tipo:$('#tipo_examen').val()

			};
			console.log("***********");
			console.log(data_form);

			$.post('/iess/archivos_php/diagnostico/ingresar_examn.php',data_form,function(data){
				console.log(data);
				if (data=='ok') {
					succes_refresh("Datos guardados correctamente","/iess/vistas/diagnostico/diagnostico");
				}else {
					erro_message("Error al guardar");

				}
			});
		}



	</script>


	<script type="text/javascript">

//busquueda de usuarios
$(document).on('click','#diagnostico_cargar_combo',function(e){


	e.preventDefault();
	const data_form ={
		apellido_paciente: $('#buscar_paciente').val()
	};
	;
	$.post('/iess/archivos_php/diagnostico/consultar_paciente.php',data_form,function(response){


		let lista_paciente = JSON.parse(response);
		let plantilla = '<option value="not_value" >Pacientes encontrados</option>';

		lista_paciente.forEach(usuario=>{
			plantilla+=`
			<option value="${usuario.id_paciente}">${usuario.nombre}</option>
			`;
		});

		$('#diagnostico_paciente').empty();
		$('#diagnostico_paciente').append(plantilla);

	});
});


$(document).on('change','#diagnostico_paciente',function(){

	if ($(this).val()=='not_value') { return;}

	var nombres=$('select[name="diagnostico_paciente"] option:selected').text();
	var id_paciente = $(this).val();
	$('#paciente').val(nombres);
	
	consultar_si_exite_diagnostico(id_paciente);

});	 

</script>
 

<script type="text/javascript">
	//consultar diagnostico

	function consultar_si_exite_diagnostico(id_paciente){

		$.post('/iess/archivos_php/diagnostico/existe_diagnostico.php',{id:id_paciente},function(response){
			let lista = JSON.parse(response);	
			
			lista.forEach(diagnostico=>{

				$('#id_diag').val(diagnostico.id_diagnotico);

				$('#diag').val(diagnostico.diagnostico);

			});

		});
	}
</script>



<script type="text/javascript">

	$(document).on('click','#s_paciente',function(e){
		e.preventDefault();
		var name =$('#s_nom_paciente').val();
		$('#diagnostico_nombre_paciente').val(name);
		var id_paciente = $('#s_id_paciente').val();
		$('#paciente').val(name);
		consultar_si_exite_diagnostico(id_paciente);
	});
	
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

</body>
</html>