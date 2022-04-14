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

	



		<div class="col-1">	</div>
		<!-- Formulario 1*****************************************-->
		<div class="col-xs-12 col-md-6  mt-5 shadow"  >




			<h6 class="text-center pt-3">ACTUALIZAR PRESCRIPCIÓN MÉDICA</h6>


			<form action="" id="fomr_prescripcio">
				<div class="row">
					
					<div class="col">
						<label class="form-label">Paciente</label>
						<input type="text" class="form-control" id="diagnostico_nombre_paciente" name="diagnostico_nombre_paciente"  disabled 
						value="<?php echo $_GET['paciente'];?>">
						<input type="hidden" id="id_prescripcion" value="<?php echo $_GET['id_prescripcion'];?>"/>
						
					</div>

				</div>
				<hr>
				<h6>Nueva Prescripción</h6>


				<div>
					
					<button class="btn btn-success" id="add">Add</button>
					<div id="canvas_ant">
					<label class="form-label text-center  d-block">Antibióticos	</label>
					
					<?php 
					$aux = $_GET['antibiotico'];
					$antibioticos = explode(",",$aux);
					
					$cont = 50;
					for ($i=0; $i < count($antibioticos) ; $i=$i+14) { 
						for($j = 0; $j < 14; $j++){
							$pos = $i +$j ;
							echo "<input type='hidden' name=dat[] value='$antibioticos[$pos]'/>";
						}
					}
					?>
					</div>
					<br>
				</div>

				<hr>

				<div class="col-12">
			     <label class="form-label">Comentarios</label>
				 <textarea class="form-control" id="comentario" rows="3"><?php echo $_GET['comentario'];?></textarea>
				</div>

				<div class="col text-center">
					<a href="resumen_diagnostico" class="btn btn-secondary">Cancelar</a>
					<button class="btn btn-primary my-3" id="btn_guardar">Actualizar</button>

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
  <div class="modal-dialog modal-lg" role="document">
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
					<input type="date" class="form-control"  id="inicio"> </div>
					<div class="col-4">
						<label class="form-label">Tiempo (días)</label>
						<input type="number" class="form-control" name="tiempo" id="tiempo" min="0" value="0" >
					</div>
					<div class="col-4">
						<label class="form-label">Fecha fin</label>
						<input disabled type="date" class="form-control" name="fin" id="fin">
					</div>

					<hr>

					<div class="col-3">
						<label class="form-label">Escala</label>
						<select class="form-select" id="escala" name="escala">
							<option>NO</option>
							<option>SI</option>

						</select>
					</div>
					<div class="col-3">
						<label class="form-label">Mantien</label>
						<select class="form-select" id="mantiene" name="mantiene">
							<option>NO</option>
							<option>SI</option>

						</select>
					</div>
					<div class="col-3">
						<label class="form-label">Descala</label>
						<select class="form-select" id="descala" name="descala">
							<option>NO</option>
							<option>SI</option>
						</select>
					</div>
					<div class="col-3">
						<label class="form-label">Ajuste dosis</label>
						<select class="form-select" id="ajuste" name="ajuste">
							<option>NO</option>
							<option>SI</option>
						</select>
					</div>	
					<div class="col-3">
						<label class="form-label">Empírico</label>
						<select class="form-select" id="empirico" name="empirico">
							<option>NO</option>
							<option>SI</option>
						</select>
					</div>	
      </div>
      <div class="modal-footer">
	  <button type="button" class="btn btn-primary" data-dismiss="modal" id="carga_ant">Seleccionar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar_ant" onclick="$('#modal_ant').modal('hide')">Cerrar</button>
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
		//console.log(data_form_global)

		

		if (Object.keys(data_form_global).length <= 0) {
			erro_message("Error: Selecione almenos una antibiótico");
			return;
		}

		
		data_form_global.push({"id":999,"id_ant":$('#id_prescripcion').val(),"comentario":$('#comentario').val()});
		
		//console.log(data_form_global)
		
		var aux_data = JSON.stringify(data_form_global);
		
		$.post("../../archivos_php/diagnostico/update_prescripcion.php",{myData:aux_data},function(response){
			
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
	var estado = false;
	var aux_indice = 0;
	//mostrar modal 
	var i = 100;
	$("#add" ).click(function(e) {
            e.preventDefault();
			$("#antibiotico").val();	
				$("#dosis").val(0);
				$("#unidad").val();
				$("#via").val();
				$("#metodo").val();
				$("#inicio").val();
				$("#tiempo").val(0);
				$("#fin").val();
				$("#escala").val();
				$("#mantiene").val();
				$("#descala").val();
				$("#ajuste").val();
				$("#empirico").val();
			$('#modal_ant').modal('show');
    });


	///cargar antibiotico en el json

	$(document).on('click', '#carga_ant', function(e){
		function isNormalInteger(str) { var n = ~~Number(str); return String(n) === str && n >= 0; }
		
		var n = $("#tiempo").val();
		if(!isNormalInteger(n)){
			//alert("El campo de días solo acepta números enteros positivos.");
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

		if(estado == true){
			//alert("tenemos que actualizar con el id: "+aux_indice);
			///eliminar obj
			const removeById = (arr, id) => {
				const requiredIndex = arr.findIndex(el => {
					return el.id == String(id);
				});
				if(requiredIndex == -1){
					return false;
				};
				return !!arr.splice(requiredIndex, 1);
			};
			removeById(data_form_global,aux_indice)
			///eliminar obj
			estado = false;
			aux_indice = 0;



		}


		data_form_global.push({
								"id":i,
								"id_ant":id_ant,
								"ant":ant,
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
		
		i++;
		//console.log(data_form_global);
		mostrarantibioticos()

		$('#modal_ant').modal('hide');
	});


//eliminar objetos
	$(document).on('click', '.del', function(e){
            e.preventDefault();
			if (!confirm("¿Eliminar antibiótico?")) {
				return;
			}
            var button_id = $(this).attr("id");
           
			///eliminar obj
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
			///eliminar obj
			mostrarantibioticos();
			
			
    });
	function objt_a_eliminar(){
		
	}


</script>


<script type="text/javascript">
cargar_prescripcion_old();
mostrarantibioticos();
function cargar_prescripcion_old(){

			let data = $.map($('input[type=hidden][name="dat[]"]'), function(el) { return el.value; });
			for (let index = 0; index < data.length; index= index+14) {
				data_form_global.push({
								"id":index,
								"id_ant":data[index],
								"ant":data[index+1],
								"dosis":data[index+2],
								"unidad":data[index+3],
								"via":data[index+4],
								"metodo":data[index+5],
								"inicio":data[index+6],
								"tiempo":data[index+7],
								"fin":data[index+8],
								"escala":data[index+9],
								"mantiene":data[index+10],
								"descala":data[index+11],
								"ajuste":data[index+12],
								"empirico":data[index+13]
							});
			}
	}

function mostrarantibioticos(){
	let  antibiotico="";

	data_form_global.forEach(element => {
		antibiotico += `<div id="ant${element.id}" class="pb-2 ">
								<label class="bg-warning d-block">
									<strong>Antibiótico:</strong> ${element.ant}<br>
									<strong>Dosis:</strong> ${element.dosis},	<strong>Unidad:</strong> ${element.unidad},	<strong>Vía:</strong> ${element.via},	<strong>Método:</strong> ${element.metodo}<br>
									<strong>Fecha:</strong> ${element.inicio},    ${element.tiempo} <strong>días</strong>,   ${element.fin}<br>
									<strong>Escala:</strong> ${element.escala}, <strong>Mantien:</strong> ${element.mantiene},	<strong>Descala:</strong> ${element.descala},	<strong>Ajuste:</strong> ${element.ajuste}, <strong>Empírico:</strong> ${element.empirico}	
								</label>
								<button class="del btn btn-danger " id = "${element.id}">X</button>
								<a class="update" id_update ="${element.id}" href="#"><img src="../../imagenes/update.png"/></a>
						  </div>`;
						 
	});
		$("#canvas_ant").empty();
		$("#canvas_ant").append(antibiotico);
}


$(document).on('click', '.update', function(e){
				e.preventDefault();
				var button_id = $(this).attr("id_update");
				estado = true;
				aux_indice = button_id;
				
				
				console.log(data_form_global)
				data_form_global.forEach(element => {
					if(element.id == button_id){
						console.log(element)
						$("#antibiotico").val(element.id_ant);	
						$("#dosis").val(element.dosis);
						$("#unidad").val(element.unidad);
						$("#via").val(element.via);
						$("#metodo").val(element.metodo);
						$("#inicio").val(element.inicio);
						$("#tiempo").val(element.tiempo);
						$("#fin").val(element.fin);
						$("#escala").val(element.escala);
						$("#mantiene").val(element.mantiene);
						$("#descala").val(element.descala);
						$("#ajuste").val(element.ajuste);
						$("#empirico").val(element.empirico);
					}
				});
				
				
				$('#modal_ant').modal('show');
})
</script>



</body>
</html>