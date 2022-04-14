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
	<title>Prescripción médica</title>
	<link rel="icon" href="../../imagenes/favicon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../css/b_css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../../css/mensaje_error.css">
	<style type="text/css" media="screen">

	.modal-lg { max-width: 85% !important; }

	</style>
</head>
<body>
	

	<?php
	include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/header.php");
	include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/diagnostico/cargar_antibiotico.php");

	?> 

	<div class="row">

		<?php
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar_diagnostico.php");
		//echo $navbar_diagnostico;
		include("menu.php"); 
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

		if (isset($_GET['id_diag'])) {


			echo "<input type='hidden' id='id_diagnostico' value='".$_GET['id_diag']."' >";
			$temp_paciente = $_GET['pa'];
			$temp_diagnostico = $_GET['diag'];
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
				<h6>Nueva Prescripción</h6>


				<div>
					
					<button class="btn btn-success" id="add">Add</button>
					<div id="canvas_ant">
					<label class="form-label text-center  d-block">Antibióticos	</label>	
					</div>
					<br>
				</div>

				<hr>

				<div class="col-12">
			     <label class="form-label">Comentarios</label>
				 <textarea class="form-control" id="comentario" rows="3"></textarea>
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


			<!--modal++++++++++++++-->
<div class="modal" tabindex="-1" role="dialog" id="modal_ant"> 
  <div class="modal-dialog modal-lg bg-danger"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Antibioticos</h5>
      </div>
      <div class="modal-body">
	  <div class="row">
		 	   <div class="col-3">
			     <label class="form-label">Nombre</label>
					<select class="form-select" id="antibiotico" name="antibiotico">
						<?php
						echo $combo_antibiotico;
						?> 

					</select>
				</div>

				<div class="col-2">
					<label class="form-label">Dosis</label>
					<input type="text" class="form-control" name="dosis" id="dosis" value="0">
				</div>
				<div class="col-2">
					<label class="form-label">Unidad</label>
					<select class="form-select" id="unidad">
						<option></option>
							<option>Unidad Gramos</option>
							<option>Unidad miligramos</option>
							<option>Unidad UI</option>						
					</select>
				</div>
				
				<div class="col-2">
					<label class="form-label">Vía</label>
					<select class="form-select" id="via">
						<option></option>
							<option>Vía de administración Endovenosa</option>
							<option>Vía de administración Intramuscular</option>
							<option>Vía de administración Oral</option>
							<option>Vía de administración subcutánea</option>				 

					</select>
				</div>

				<div class="col-2">
					<label class="form-label">Método</label>
					<select class="form-select" id="metodo">
						<option></option>
							<option>Método de infusión Infusión continua</option>
							<option>Método de infusión Dosis de carga</option>
							<option>Método de infusión Ninguna</option>
							<option>Método de infusión Las dos</option>	
					</select>
				</div>

				<hr>

				<hr>
				<div class="col-4">
					<label class="form-label">Fecha de Registro</label>
					<input disabled type="date" class="form-control"  id="inicio"> </div>
					<div class="col-4">
						<label class="form-label">Tiempo (días)</label>
						<input type="number" class="form-control" name="tiempo" id="tiempo" min="0" value="0" >
					</div>
					<div class="col-4">
						<label class="form-label">Fecha fin</label>
						<input disabled type="date" class="form-control" name="fin" id="fin">
					</div>

					<hr>

					<div class="col-2">
						<label class="form-label">Escala</label>
						<select class="form-select" id="escala" name="escala">
							<option>NO</option>
							<option>SI</option>

						</select>
					</div>
					<div class="col-2">
						<label class="form-label">Mantien</label>
						<select class="form-select" id="mantiene" name="mantiene">
							<option>NO</option>
							<option>SI</option>

						</select>
					</div>
					<div class="col-2">
						<label class="form-label">Descala</label>
						<select class="form-select" id="descala" name="descala">
							<option>NO</option>
							<option>SI</option>
						</select>
					</div>
					<div class="col-2">
						<label class="form-label">Ajuste dosis</label>
						<select class="form-select" id="ajuste" name="ajuste">
							<option>NO</option>
							<option>SI</option>
						</select>
					</div>	
					<div class="col-2">
						<label class="form-label">Empírico</label>
						<select class="form-select" id="empirico" name="empirico">
							<option>NO</option>
							<option>SI</option>
						</select>
					</div>	
      </div>
      <div class="modal-footer">
	  <button type="button" class="btn btn-primary" data-dismiss="modal" id="carga_ant">Seleccionar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar_ant">Cerrar</button>
      </div>
    </div>
  </div>
</div>



	<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../js/sweetalert2.all.min.js"></script>
	<script type="text/javascript" src="../../js/mensaje_general.js"></script>
	<script type="text/javascript" src="../../js/jquery.validate.min.js"></script>




	<script type="text/javascript">
	//insertar prescripcion
	//validar no vacio

	var data_form_global=[];


	$(document).on('click','#btn_guardar',function(e){
		e.preventDefault();
	
		if (!$('#id_diagnostico').length) {
			erro_message("Error: Selecione un diagnóstico en el menú resumen");
			return;
		}else if (Object.keys(data_form_global).length <= 0) {
			erro_message("Error: Selecione almenos una antibiótico");
			return;
		}

		
		data_form_global.push({"id":999,"id_diag":$('#id_diagnostico').val(),"comentrio":$('#comentario').val()	});
		
		//console.log(data_form_global)
		var aux_data = JSON.stringify(data_form_global);
		
		$.post("../../archivos_php/diagnostico/ingresar_prescripcion.php",{myData:aux_data},function(response){
			
			console.log(response);
			if (response=='ok') {
				succes_refresh("Prescripcion Creada",'../../vistas/diagnostico/resumen_diagnostico');
			}else{
				erro_message("Error de ingreso");
			}
		});

	});


	
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
			$('#inicio').val(fecha_actual);
			$('#fin').val(fecha_actual);


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



<script type="text/javascript">
	var i = 1;
	$("#add" ).click(function(e) {
            e.preventDefault();
			$('#modal_ant').modal('show');
    });

	function isNormalInteger(str) { var n = ~~Number(str); return String(n) === str && n >= 0; }

	$(document).on('click', '#carga_ant', function(e){
		var n = $("#tiempo").val();
		if(!isNormalInteger(n)){
			alert("El campo de días solo acepta números enteros positivos.");
			return;
		}

		var id_ant = $("#antibiotico").val();
		var ant = $('select[name="antibiotico"] option:selected').text();
		var dosis = $("#dosis").val();
		var unidad = $("#unidad").val();
		var via = $("#via").val();
		var metodo = $("#metodo").val();
		var inicio = $("#inicio").val();
		var tiempo = $("#tiempo").val();
		var fin = $("#fin").val();
		var escala = $("#escala").val();
		var mantiene = $("#mantiene").val();
		var descala = $("#descala").val();
		var ajuste = $("#ajuste").val();
		var empirico = $("#empirico").val();


		data_form_global.push({
								"id":i,
								"id_ant":id_ant,
								"dosis":dosis,
								"unidad":unidad,
								"via":via,
								"metodo":metodo,
								"inicio":inicio,
								"tiempo":tiempo,
								"fin":fin,
								"escala":escala,
								"mantiene":mantiene,
								"descala":descala,
								"ajuste":ajuste,
								"empirico":empirico
							
							});
		
		
		//console.log(data_form_global);
		

		let antibiotico= `<div id="ant${i}" class="pb-2 ">
								<label class="bg-warning d-block">
									<strong>Antibiótico:</strong> ${ant}<br>
									<strong>Dosis:</strong> ${dosis},	<strong>Unidad:</strong> ${unidad},	<strong>Vía:</strong> ${via},	<strong>Método:</strong> ${metodo}<br>
									<strong>Fecha:</strong> ${inicio},    ${tiempo} <strong>días</strong>,   ${fin}<br>
									<strong>Escala:</strong> ${escala}, <strong>Mantien:</strong> ${mantiene},	<strong>Descala:</strong> ${descala},	<strong>Ajuste:</strong> ${ajuste}, <strong>Empírico:</strong> ${empirico}	
								</label>
								<button class="del btn btn-danger " id = ${i}>X</button>
						  </div>`;
		$("#canvas_ant").append(antibiotico);
		i++;
		$('#modal_ant').modal('hide');
	});



	$(document).on('click', '.del', function(e){
            e.preventDefault();

			


            var button_id = $(this).attr("id");
            $('#ant'+button_id+'').remove();

			const removeById = (arr, id) => {
				const requiredIndex = arr.findIndex(el => {
					
					return el.id == String(id);
				});
				if(requiredIndex == -1){
					return false;
				};
				return !!arr.splice(requiredIndex, 1);
			};
			removeById(data_form_global,button_id)
			//console.log(data_form_global);
			
    });

	$(document).on('click', '#cerrar_ant', function(e){
            e.preventDefault();
			$('#modal_ant').modal('hide');
    });
</script>



</body>
</html>