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

	<div class="row  position-relative pb-2 ">
		<?php
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar.php");
		//echo $navbar_laboratorio; 
		$python = `python3 menu.py`;
		echo $python; 
		?>

		<div class="col-1">	</div>
		<!-- Formulario 1*****************************************-->
		<div class="col-xs-12 col-md-6  mt-5 shadow"  >
			<h6 class="text-center">Formulario de Muestras</h6>

			<div class="container ">
				<form>
					<div class="col-5 d-inline-block">
						<label class="form-label">Paciente</label>
						<input class="form-control" type="text" value="<?php 
						if(isset($_SESSION['l_s_paciente']))
						echo $_SESSION['l_s_paciente'];
					?>" disabled>
				</div>

				<div class="col-6 d-inline-block">
					<label class="form-label">Nombre Médico</label>
					<input class="form-control" type="text" name="doctor" id="doctor" disabled="" value="<?php 
					 
					echo $usuario;
				?>">
			</div>
			<div>
				<label class="form-label">Diagnóstico</label>
				<textarea class="form-control mb-3" id="" rows="3" disabled>
					<?php 
					if(isset($_SESSION['l_s_diagnostico']))
						echo $_SESSION['l_s_diagnostico'];
					?>
				</textarea>
				<input type="hidden" name="id_pedido_examen" id="id_pedido_examen" value="<?php 
				if(isset($_SESSION['l_s_id_pedido_examen']))
				echo $_SESSION['l_s_id_pedido_examen'] ?>">
			</div>

			<div class="col-4 d-inline-block">
				<label class="form-label">Fecha Recepción</label>
				<input class="form-control" type="date" name="f_rcepcion" id="f_rcepcion" value="<?php echo date('Y-m-d'); ?>" >
			</div>
			<div class="col-3 d-inline-block">
				<label class="form-label">Fecha Muestra</label>
				<input class="form-control" type="date" name="f_muestra" id="f_muestra" disabled >
			</div>
			<div class="col-4 d-inline-block" >
				<label class="form-label">Fecha  Alarma</label>
				<input class="form-control" type="date" name="f_alarma" id="f_alarma" value="<?php echo date('Y-m-d'); ?>" >
			</div> 
			<div>
				<label class="form-label">Numero de frascos</label>
				<input class="form-control" type="number" name="n_frascos" id="n_frascos">
			</div> 					
			<div >
				<label class="form-label">Resultado</label>
				<input class="form-control" type="text" name="resultado" id="resultado">
			</div> 
			<div class="col text-center">
			<button class="btn btn-primary my-3 " id="btn_crear">Crear</button>
		</div>
		</form>
	</div>
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
<script type="text/javascript">
	$('#submenu_tecnicas').hover(function(){
		$('#id_sumbenu').show();
	}, function(){
		$('#id_sumbenu').hide();

	});
</script>


<script type="text/javascript">

	$(document).on('click','#btn_crear',function(e){

		e.preventDefault();
		 
		if ($('#id_pedido_examen').val()=='') {
			erro_message("Seleccione un paciente");
			return;
		}
		crear_muestra();
	});


	function crear_muestra(){
		var data_form={
			id_examen:$('#id_pedido_examen').val(),
			doctor:$('#doctor').val(),
			f_rcepcion:$('#f_rcepcion').val(),
			f_muestra:$('#f_muestra').val(),
			f_alarma:$('#f_alarma').val(),
			n_frascos:$('#n_frascos').val(),
			resultado:$('#resultado').val() 
		};
		$.post('/iess/archivos_php/laboratorio/ingresar_muestra.php', data_form, function(data) {
			if (data=='ok') {
				succes_refresh("Guardado correctamente","/iess/vistas/laboratorio/tincion_gram");
			}
			else {
				erro_message("Error, llene todos los campos");
			}

		});


	}
</script>
<script type="text/javascript">
	consultar_fecha();
	function consultar_fecha(){
		if ($('#id_pedido_examen').val()!="") {
			$.post('/iess/archivos_php/laboratorio/buscar_fecha_pedido_examen.php', {id: $('#id_pedido_examen').val()}, function(data) {
			 console.log(data);
			 $('#f_muestra').val(data);
			});
		}

	}
</script>

</body>


</html>