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
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar.php");
		//echo $navbar_laboratorio; 
		$python = `python3 menu.py`;
		echo $python; 
		?>

		<div class="col-1">	</div>
		<!-- Formulario 1*****************************************-->
		<div class="col-xs-12 col-md-6  mt-5 shadow"  >
			<h6 class="text-center pt-3">Formulario Tinción de Gram</h6>

			<div class="container ">
				<form>
					<div class="col-6 d-inline-block">
						<label class="form-label">Paciente</label>
						<input disabled class="form-control" type="text" value="<?php if(isset($_SESSION['l_s_paciente']))
						echo $_SESSION['l_s_paciente'];
					?>" id="paciente">
					<input type="hidden" value="<?php if(isset($_SESSION['l_s_id_muestra']))
					echo $_SESSION['l_s_id_muestra'];
				?>" name="id_muestra" id="id_muestra" >
			</div>

			<div class="col-5 d-inline-block">
				<label class="form-label">Médico</label>
				<input disabled class="form-control" type="text" value="<?php echo $usuario; ?>" >
			</div>

			<div class="col-4 d-inline-block">
				<label class="form-label">Fecha</label>
				<input class="form-control" type="date" value="<?php date_default_timezone_set('America/Guayaquil');
				echo date('Y-m-d');?>">
			</div>



			<div class="col-3 d-inline-block">
				<label class="form-label">Resultado</label>
				<select class="form-select" id="combo_estado">
				</select>
			</div>

			<div class="col-4 d-inline-block">
				<label class="form-label">Alarma</label>
				<select class="form-select" id="alarma">
					<option value="0">No</option>
					<option value="1">Si</option>

				</select>
			</div>

		
			 		 
			<br>

			<div class="col text-center">
			<button class="btn btn-primary my-3"id="btn_tincion">Crear</button>
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
<script type="text/javascript" src="/iess/js/mensaje_general.js"></script>
<script type="text/javascript" src="/iess/js/sweetalert2.all.min.js"></script>
<script type="text/javascript">
	$('#submenu_tecnicas').hover(function(){
		$('#id_sumbenu').show();
	}, function(){
		$('#id_sumbenu').hide();

	});
</script>

<script type="text/javascript">
	cargar_combo_estado();
	function cargar_combo_estado(){
		$.ajax({
			url: '/iess/archivos_php/laboratorio/cargar_combo_ticion_gram.php',
			type: 'GET',
			success: function(data) {
 
				  	let lista = JSON.parse(data);
				  	let plantilla = '';
				  	lista.forEach(estado=>{
				  		plantilla+=`<option value= "${estado.id_estado}">${estado.estado}</option>`;

				  	});
				  	$('#combo_estado').append(plantilla);
				  }

				});

	}
</script>


<script type="text/javascript">



	$(document).on('click','#btn_tincion',function(e){
		e.preventDefault();
		guardar_ticion();
	});
	function guardar_ticion(){


		if ($('#paciente').val()=="") {
			erro_message("Seleccione un paciente");
			return;
		}


		if ($('#id_muestra').val()=="") {
			erro_message("Cree una Muestra");
			return;
		}


		const data_form = {
			id_muestra:$('#id_muestra').val(),
			combo_estado:$('#combo_estado').val(),
			alarma:$('#alarma').val(),
			numero_tecnicas:0
			 
		};

		$.post('/iess/archivos_php/laboratorio/ingresar_gram.php',data_form,function(response){
			//console.log(response);
			if (response=='ok') {
				succes_refresh("Guardado","/iess/vistas/laboratorio/tecnicas");
			}else {
				erro_message("Error, llene todos los campos");
			}
		});


	}

</script>

</body>
</html>