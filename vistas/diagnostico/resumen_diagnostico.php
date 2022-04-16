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
			<title>Resumen</title>
			<link rel="icon" href="../../imagenes/favicon.png">


			<meta name="viewport" content="width=device-width, initial-scale=1.0">

			<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>	
			<link rel="stylesheet" type="text/css" href="../../css/b_css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="../../css/menu.css">
			<style type="text/css">
		body{    

			overflow-x: hidden;
		}
		table{
    table-layout: fixed;
    width: 250px;
}

th, td {
    /*border: 1px solid black;*/
    width: 250px;
    word-wrap: break-word;
}
.tr_grande{
	width: 380px;
}

tr {
	border: 1px solid black;
}
.contenedor_tr{
	width: 850px;
}

.contenedor{
	width: 350px;


}


	</style>


		</head>
		<body style="zoom:80%">


			<?php
			include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/header.php");

			?>

			<div class="row">
				<?php
				include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar_diagnostico.php");
		//echo $navbar_diagnostico;
		include("menu.php");
				?>




				<!-- Formulario 1*****************************************-->
				<div class="col-xs-12 col-md-9  	mt-1 shadow" style="width: 82%; height: 640px; overflow-y: scroll;  overflow-x: scroll; " >

					<div class="col-5 pb-3 pt-1 d-inline-block">
						<input type="text" id="buscar_admin" class="form-control rounded" placeholder="Buscar" aria-label="Search"	aria-describedby="search-addon" />
						
					</div>
					<button class="btn btn-success mx-3" id="buscar_paciente_x_nombre">Buscar</button>

					<?php 
				//include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/diagnostico/resumen.php");
					?>	

					<table class=" table  table-striped" >
						<thead>
							<tr>
								<th>DATOS PERSONALES</th>
								<th class="tr_grande">DIAGNÓSTICO</th>
								<th>PRESCRIPCIÓN</th>
								<th>PEDIDO EXAMEN</th>
								<th>OPCIONES</th>
								<th  colspan="3" class="contenedor_tr">RESUMEN LABORATORIO</th>
								


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
										<option >Sangre</option>
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
			<script type="text/javascript" src="../../js/sweetalert2.all.min.js"></script>
			<script type="text/javascript" src="../../js/mensaje_general.js"></script>


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
					$.post('../../archivos_php/diagnostico/ingresar_examn.php', data_form, function(data) {
						console.log(data)
						if (data=="ok") {
							$('#modal_pedido_examen').modal('hide');
							succes_refresh("Datos Guardados",'../../vistas/diagnostico/resumen_diagnostico');
							//succes_message("Datos Guardados");
							
						}
					});


				});




			</script>


			<script type="teXt/javascript">
				function desplegar(tabla_a_desplegar,estadoT) {
					var tablA = document.getElementById(tabla_a_desplegar);
					var estadOt = document.getElementById(estadoT);

					switch(tablA.style.display) {
						case "none":
						tablA.style.display = "block";
						//estadOt.innerHTML = "Ocultar coneNido"
						break;
						default:
						tablA.style.display = "none";
						//estadOt.innerHTML = "Mostrar coNteNido"
						break;
					}
				}
			</script>

			<script type="text/javascript">
				
				$("#buscar_paciente_x_nombre").on("click", function(e) {
					e.preventDefault();
					$.post('../../archivos_php/diagnostico/resumen.php', {"paciente_name":$("#buscar_admin").val()}, function(data) {
						//console.log(data)

						let lista_general = JSON.parse(data);
						let plantilla = '';
						var control_duplicados= [];
						var cont_duplicados = 0;
					lista_general.forEach(usuario=>{
						var cont_opciones = 0;
						var enfermedades = "";
						var enfermedades_na_format = "";
						var enfermedadeswhitid = [];
					
						let cont = 0;
						//console.log(usuario.enfermedades.length)
						for (let index = 0; index < usuario.enfermedades.length; index++) {
							enfermedades+="-"+usuario.enfermedades[index].enfermedad+" <br> ";	
							enfermedades_na_format += usuario.enfermedades[index].enfermedad+", ";	
							enfermedadeswhitid[cont] = usuario.enfermedades[index].id_enfermedad;
							enfermedadeswhitid[cont+1] = usuario.enfermedades[index].enfermedad;
							cont = cont+2;
						}


 

						antibioticos = "";
						antibioticosWhithID = [];
						let contador = 0; 
						for (let index = 0; index < usuario.antibioticos.length; index++) {
							antibioticos+="<strong>Antibiotico: </strong>"+usuario.antibioticos[index].antibiotico_nombre+" <br> ";
							antibioticos+="<strong>Dosis: </strong>"+usuario.antibioticos[index].dosis+" <br> ";
							antibioticos+="<strong>Unidad: </strong>"+usuario.antibioticos[index].unidad+" <br> ";
							antibioticos+="<strong>Vía: </strong>"+usuario.antibioticos[index].via+" <br> ";	
							antibioticos+="<strong>Método: </strong>"+usuario.antibioticos[index].metodo+" <br> ";
							antibioticos+=""+usuario.antibioticos[index].inicio+" ";
							antibioticos+=" ("+usuario.antibioticos[index].dias+" días) ";
							antibioticos+=""+usuario.antibioticos[index].fin+" <br> ";
							antibioticos+="<strong>Escala: </strong>"+usuario.antibioticos[index].escala+"  ";
							antibioticos+="<strong>Mantiene: </strong>"+usuario.antibioticos[index].mantiene+" <br> ";
							antibioticos+="<strong>Descala: </strong>"+usuario.antibioticos[index].descala+"  ";
							antibioticos+="<strong>Ajuste: </strong>"+usuario.antibioticos[index].ajuste+"   ";
							antibioticos+="<strong>Empírico: </strong>"+usuario.antibioticos[index].empirico+"<hr>";

							antibioticosWhithID[contador] = usuario.antibioticos[index].id_antibiotico;
							antibioticosWhithID[contador+1] = usuario.antibioticos[index].antibiotico_nombre;
							antibioticosWhithID[contador+2] = usuario.antibioticos[index].dosis;
							antibioticosWhithID[contador+3] = usuario.antibioticos[index].unidad;
							antibioticosWhithID[contador+4] = usuario.antibioticos[index].via;
							antibioticosWhithID[contador+5] = usuario.antibioticos[index].metodo;
							antibioticosWhithID[contador+6] = usuario.antibioticos[index].inicio;
							antibioticosWhithID[contador+7] = usuario.antibioticos[index].dias;
							antibioticosWhithID[contador+8] = usuario.antibioticos[index].fin;
							antibioticosWhithID[contador+9] = usuario.antibioticos[index].escala;
							antibioticosWhithID[contador+10] = usuario.antibioticos[index].mantiene;
							antibioticosWhithID[contador+11] = usuario.antibioticos[index].descala;
							antibioticosWhithID[contador+12] = usuario.antibioticos[index].ajuste;
							antibioticosWhithID[contador+13] = usuario.antibioticos[index].empirico;

							contador = contador + 14;

						}
		



						plantilla+=`

						<tr id_lista_usurios="${usuario.id_prescripcion}" >

						<td >
						${usuario.nombre_paciente}<br>
						( ${usuario.historia_clinica} )<br>
						Médico : ${usuario.nombre_medico}
						</td>
						<td>
							${usuario.id_diagnostico}<br>
							<strong>Enfermedades: </strong><br> ${enfermedades}
							<strong>Fecha:</strong> ${usuario.fecha_diagnostico}<br>
							<strong>Comentario:</strong> ${usuario.comentario_diagnostico}<br>
							<a class="update_diagnostico" href="update_diagnostico?id_diagnostico=${usuario.id_diagnostico}&paciente=${usuario.nombre_paciente}&comentario=${usuario.comentario_diagnostico}&enfermedades=${enfermedadeswhitid}" class=" "><img src="../../imagenes/update.png"/></a>
							
						</td>	
						`;
						if (usuario.id_prescripcion!=null) {
							control_duplicados[cont_duplicados]=usuario.id_diagnostico;
							cont_duplicados++;
							cont_opciones++;
							plantilla+=`
							
							<td>
							${usuario.id_prescripcion}<br>
							<label style="cursor:pointer; cursor: hand;" onClick="desplegar('${usuario.id_prescripcion}','estadoT')" ><strong><u>Ver más..[+] </u></strong></label> <br>
							<div  id='${usuario.id_prescripcion}' style="display: none;"> 
								${antibioticos}
							</div>
							<br>
							<strong>Comentario: </strong>${usuario.comentario_prescripcion}							
							
							<br>
							<a class="update_prescripcion" href="update_prescripcion_medica?id_prescripcion=${usuario.id_prescripcion}&paciente=${usuario.nombre_paciente}&antibiotico=${antibioticosWhithID}&comentario=${usuario.comentario_prescripcion}" class=" "><img src="../../imagenes/update.png"/></a>
							`;
							if(usuario.id_pedido_examen != null){
								plantilla+=`<a class="update_prescripcion btn btn-success" href="prescripcion_medica?id_diag=${usuario.id_diagnostico}&diag=${enfermedades_na_format}&pa=${usuario.nombre_paciente}" class=" ">ADD</a>`;					
							}
							plantilla+=`</td>`;
							
						} 
						if (usuario.id_pedido_examen!=null ) {
							cont_opciones++;
							plantilla+=`
								<td>
								${usuario.id_pedido_examen}<br>
								<strong>Tipo: </strong>${usuario.tipo_examen}<br>
								<strong>Fecha: </strong>${usuario.fecha_examen}<br>
								</td>	
								`;
						}

						

						if(cont_opciones == 0){
							plantilla+=`<td></td>
										<td></td>
										<td>
											<a href="prescripcion_medica?id_diag=${usuario.id_diagnostico}&diag=${enfermedades_na_format}&pa=${usuario.nombre_paciente}" class="btn btn-primary"> Crear prescipcion</a>
											
										</td>`;//
						}else if(cont_opciones == 1){
							plantilla+=`<td></td> <td>`;
							if(cont_duplicados>1){
								if(control_duplicados[cont_duplicados-2] == control_duplicados[cont_duplicados-1]){
									console.log("Ya no puede pedir examen "+cont_duplicados)
									plantilla+=`Ya solicitó examen`;
								}else{
									console.log("puede pedir examen "+cont_duplicados)
									plantilla+=`<button class="btn btn-primary btn_pedir_examen my-1">Pedir Examen</button>`;
								}
							}else{
								console.log("puede pedir examen "+cont_duplicados)
								plantilla+=`<button class="btn btn-primary btn_pedir_examen my-1">Pedir Examen</button>`;
							}
							
							plantilla+=`</td>`;
						}else if(cont_opciones == 2){
							plantilla+=`<td>Terminado <br> ver proceso----> </td>`;
						}

						
						plantilla+=`<td class="contenedor">`;
						if(usuario.id_muestra != null){
							plantilla+=`

									
										<h6>Muestra</h6>
										${usuario.id_muestra}<br>
										fecha: ${usuario.fecha_muestra}<br>
										N° Frascos: ${usuario.n_frascos}
										
									
								`;
						}
						plantilla+=`</td><td class="contenedor">`;
						if(usuario.id_gram != null){
							let aux_alarma = (usuario.alarma == 0)?"No":"Si";
							plantilla+=`
										
										<h6>Gram</h6>
										${usuario.id_gram}<br>
										fecha: ${usuario.fecha_gram}<br>
										Resultado: ${usuario.resultado_gram}<br>
										Alarma:${aux_alarma}
										
			
								`;
						}
						plantilla+=`</td><td class="contenedor">`;
						if(usuario.id_tecnicas != null){
							plantilla+=`
										<h6>Técnicas</h6> ${usuario.fecha_tecnicas}<br>`;
							
							if(usuario.bacteria_array != null){
								plantilla+=`
										<hr>
										Array<br>
										Bacteria:${usuario.bacteria_array}	<br>
										Gen Resistencia: ${usuario.resistecia_array}<br>
										Observacion: ${usuario.observacion_array}

										`;
							}
							if(usuario.bacteria_antibiograma!= null){
								plantilla+=`
										<hr>
										Antibiograma<br>
										Bacteria:${usuario.bacteria_antibiograma}	<br>
										Fenotipo: ${usuario.fenotipo_antibiograma}<br>
										Reporte: ${usuario.reporte_antibiograma}<br>
										Observacion: ${usuario.observacion_antibiograma}
										
										`;
							}
							if(usuario.bacteria_eplex){
								plantilla+=`
								<hr>
								Eplex<br>
								Bacteria:${usuario.bacteria_eplex}	<br>
								Mec Resistencia:${usuario.resitencia_eplex} <br>
								observacion: ${usuario.observacion_eplex}`;
							}
						}

						plantilla+=`</td></tr>`;

					});

					if(lista_general.length==0){
						plantilla = `<tr><td></td><td></td><td><h2 class="red">No existe registro con ese nombre</h2></td><td></td><td></td></tr>`;
					}

					$('#usuario_admin').html(plantilla);

						
					});

				})

			</script>



		</body>
		</html>