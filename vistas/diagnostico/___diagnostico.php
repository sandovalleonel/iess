<?php
session_start();
$usuario = $_SESSION['username'];
$id_medico = $_SESSION['id_medico'];
if (!isset($usuario)){
	header("location: ../../index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dianóstico</title>
	<link rel="icon" href="../../imagenes/favicon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../css/b_css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../../css/mensaje_error.css">
</head>
<body>
	

	<?php
	include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/header.php");

	?>

	<div class="row  ">
		<?php
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar_diagnostico.php");
		//echo $navbar_diagnostico; 
		
		include("menu.php");
		?>

		<div class="col-1">	</div>

		<div class="col-xs-12 col-md-6  mt-5 shadow"  >
			<div class="shadow p-2">
				<div class="d-inline-block col-md-7">
					<form id="form_buscar_paciente">
						<div class="d-inline-block " style="width:60%;">
						<input class="form-control "  type="text" name="buscar_paciente" id="buscar_paciente" placeholder="Ingrese apellido..">
						</div>
						<div class="d-inline-block" style="width:30%;">
						<button class="btn btn-primary " id="diagnostico_cargar_combo" name="diagnostico_cargar_combo">Buscar</button>
						</div>
						
					</form>
				</div>
				<div class="col-md-4 col-xs-12 col-sm-12  d-inline-block ">
					<select class="form-select" style="background: #CECAC9;" name="diagnostico_paciente" id="diagnostico_paciente">
					</select>
				</div>
			</div>

			<h6 class="text-center pt-3">FORMULARIO DIAGNÓSTICO</h6>

			<div class="container "> 
				<form method="post" id="diagnostico_form">
					<div>
						<label class="form-label">Doctor</label>
						<input class="form-control" type="text" name=""  value="<?php echo $usuario?>" disabled>
						<input type="hidden" value="<?php echo $id_medico ?>" name="diagnostico_id_medico" id="diagnostico_id_medico" />
					</div>
					<div>
						<label class="form-label">Paciente</label>
						<input class="form-control mb-2" type="text" name="diagnostico_nombre_paciente" id="diagnostico_nombre_paciente" value=""  disabled />

						<input type="hidden" name="paciente_name" id="paciente_name"/>

						<input type="hidden" name="diagnostico_id_paciente" id="diagnostico_id_paciente" value="not_value">
						<label id="diagnostico_nombre_paciente_error" style="display: none; color: red;" >Seleccione un paciente</label>
					</div>
					
					<div>
						<label class="form-label">Código Enfermedad</label>
						<br>
						<div class="col-2 d-inline-block">
							<select class="form-select cod_enfermedad_combo"   id="id_abc"></select>
						</div>
						<div class="col-2 d-inline-block">
							<select class="form-select cod_enfermedad_combo" id="id_abc_numero"></select>
						</div>
						<div class="col-7 d-inline-block">

							<select class="form-select" name="diagnostico_enfermedad" id="diagnostico_enfermedad"> 
								<option value="0"></option>
							</select> 
							<label id="diagnostico_enfermedad_error" style="display: none; color: red;" >Seleccione un elemento</label>				 
						</div>
					</div>

					<div>
						<label class="form-label">Código Enfermedad 2 (Opcional)</label>
						<br>
						<div class="col-2 d-inline-block">
							<select class="form-select cod_enfermedad_combo_2" id="id_abc_2"></select>
						</div>
						<div class="col-2 d-inline-block">
							<select class="form-select cod_enfermedad_combo_2" id="id_abc_numero_2"></select>
						</div>
						<div class="col-7 d-inline-block">

							<select class="form-select" name="diagnostico_enfermedad_2" id="diagnostico_enfermedad_2"> 
								<option value="0">No seleccionado</option>
							</select> 
							<label id="diagnostico_enfermedad_error" style="display: none; color: red;" >Seleccione un elemento</label>				 
						</div>
					</div>
					

					<div class="form-group">
						<label class="form-label">Comentario</label>
						<textarea   rows="4" class="form-control " name="diagnostico_descripcion" id="diagnostico_descripcion" ></textarea>
						<label id="diagnostico_descripcion_error" style="display: none; color: red;" >Campo vacío</label>
					</div>
					<div class="col text-center">				 
						<button class="btn btn-primary my-3 " id="diagnostico_btn_crear">Crear</button>
					</div>
				</form>

			</div>
		</div>

	</div>
	<?php 
	echo $footer;
	?>


	<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="../../js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="../../js/sweetalert2.all.min.js"></script>
	<script type="text/javascript" src="../../js/mensaje_general.js"></script>

	<script type="text/javascript">
		function validacion_formulario(){
			let cont = 0;
			let mapa = new Map();
			mapa.set("diagnostico_nombre_paciente",$('#diagnostico_nombre_paciente').val().trim().length);
			//mapa.set("diagnostico_descripcion",$('#diagnostico_descripcion').val().trim().length);
			
			mapa.set("diagnostico_enfermedad",$('#diagnostico_enfermedad').val());

			mapa.forEach((valor,clave)=> {
				$('#'+clave).css("border", "1px solid #ced4da");
				$('#'+clave+"_error").hide();
				if (valor==0) {

					$('#'+clave).css("border", "1px solid red");
					$('#'+clave+"_error").show();
					cont++;
				}

			});  
			return cont;		
 
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$(document).on('click','#diagnostico_btn_crear',function(e){ 
				e.preventDefault();
				if (validacion_formulario()==0) {
					console.log('Listo para guardar');
					gurdar();
				}else {
					console.log('Aun falta llenar datos');
				}

			});

  		//insertar con ajax
  		function gurdar() {

  			let data_form={
  				diagnostico_id_paciente:$('#diagnostico_id_paciente').val(),
  				diagnostico_id_medico:$('#diagnostico_id_medico').val(),
  				diagnostico_enfermedad:$('#diagnostico_enfermedad').children("option:selected").text(),
  				diagnostico_enfermedad_2:$('#diagnostico_enfermedad_2').children("option:selected").text(),
  				diagnostico_descripcion:$('#diagnostico_descripcion').val(),
  				paciente_name:$('#paciente_name').val(),

  			};
  			
  			/*
  			let data_form = $('#diagnostico_form').serialize();
  			
  			let desc_diag = $('select[name="diagnostico_enfermedad"] option:selected').text();

  			let desc_diag2 = "";

  			($('#diagnostico_enfermedad_2').val()==0) ? desc_diag2 ="No selecionado" :  desc_diag2 = $('select[name="diagnostico_enfermedad_2"] option:selected').text();
  			

  			data_form = `${data_form}&desc_diag=${desc_diag}, ${desc_diag2}`;*/

			 

  			
  			$.post('../../archivos_php/diagnostico/insertar_diagnostico.php',data_form,function(response){
  				console.log(response);
  				if(response=='ok')
  					succes_refresh("Formulario guardado correctamente","../../vistas/diagnostico/prescripcion_medica");	 
  				else 
  					erro_message("Error al guardar");
  			});

 
  		}
  		//fin insertar ajax 

  	});

  </script>

  <script type="text/javascript">


  	$(document).on('click','#diagnostico_cargar_combo',function(e){


  		e.preventDefault();
  		const data_form ={
  			apellido_paciente: $('#buscar_paciente').val()
  		};
  		;
  		$.post('../../archivos_php/diagnostico/consultar_paciente.php',data_form,function(response){


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
  		$('#error_id_paciente').hide();

  		var nombres=$('select[name="diagnostico_paciente"] option:selected').text();

  		var id_paciente = $(this).val();
  		$('#diagnostico_nombre_paciente').val(nombres);
  		$('#paciente_name').val(nombres);
  		$('#diagnostico_id_paciente').val(id_paciente);

  		swal.close();
  	});	 

  </script>



  <script type="text/javascript">


  	function cargar_enfermedad(codigo,etiqueta,op){
  		const data_form ={
  			cod:codigo
  		};
  		$.post('../../archivos_php/diagnostico/consultar_enfermedad.php',data_form,function(response){

  			let lista = JSON.parse(response);
  			plantilla ="";

  			if(op==1)
  				plantilla ="<option value='0'></option>";

  			lista.forEach(enfermedad=>{
  				plantilla+=`
  				<option value="${enfermedad.id_enfermedad}">${enfermedad.enfermedad}</option>
  				`;
  			});
  			$('#'+etiqueta).empty();
  			$('#'+etiqueta).append(plantilla);
  			
  		});
  	}	 
  </script>


  <script type="text/javascript">
		//cargar combos enfermedad
		mostrar_combo_abecedario();
		function mostrar_combo_abecedario(){
			var plantilla="";
			var abc=["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
			for(var indice in abc){
				plantilla+=`<option>${abc[indice]}</option>`;
			}
			$('#id_abc').empty();
			$('#id_abc').append(plantilla);
			$('#id_abc_2').empty();
			$('#id_abc_2').append(plantilla);

			var plantilla2="";
			var numeros=["00","01","02","03","04","05","06","07","08","09"];
			for(var indice in numeros){
				plantilla2+=`<option>${numeros[indice]}</option>`;
			}
			for (var i = 10; i <100 ; i++) {
				plantilla2+=`<option>${i}</option>`;
			}
			$('#id_abc_numero').empty();
			$('#id_abc_numero').append(plantilla2);
			$('#id_abc_numero_2').empty();
			$('#id_abc_numero_2').append(plantilla2);


		}
	</script>

	<script type="text/javascript">
		cargar_cambio_enfermedad("diagnostico_enfermedad","",0);
		cargar_cambio_enfermedad("diagnostico_enfermedad_2","_2",1)

		$(document).on('change','.cod_enfermedad_combo',function(){
			cargar_cambio_enfermedad("diagnostico_enfermedad","",0);

		});

		$(document).on('change','.cod_enfermedad_combo_2',function(){
			cargar_cambio_enfermedad("diagnostico_enfermedad_2","_2",1);

		});		 

		function cargar_cambio_enfermedad(etiqueta,sub_etiqueta,opp){
			var letra = $('#id_abc'+sub_etiqueta).val();
			var numero = $('#id_abc_numero'+sub_etiqueta).val();
			var id=letra+numero;

			cargar_enfermedad(id,etiqueta,opp);
		}
	</script>

</body>
</html>