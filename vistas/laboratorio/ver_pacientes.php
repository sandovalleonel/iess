<?php
session_start();
$usuario = $_SESSION['username'];
if (!isset($usuario)){
	header("location: ../../index.php");
	
}
///destrir variables del laboratorio si existen

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ver</title>
	<link rel="icon" href="../../imagenes/favicon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../css/b_css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../../css/mensaje_error.css">
	<style type="text/css">
		body{    

			overflow-x: hidden;
		}
	</style>
</head>
<body style="zoom:80%" >
	

	<?php
	include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/header.php");
	date_default_timezone_set('America/Guayaquil');

	?>

	<div class="row">
		<?php
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar.php");
		//echo $navbar_laboratorio; 
		include("menu.php");
		?>



		<div class="col-xs-12 col-md-10  mt-2 shadow"  id="div_1" >

			

			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Pacientes</button>
				</li>


			</ul>
			<div class="tab-content " id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

					<div class="col-5 pb-3 pt-1">
						<input type="text" id="buscar_paciente" class="form-control rounded" placeholder="Buscar" aria-label="Search"
						aria-describedby="search-addon" />
					</div>
					<div class="col-3">
						
					</div>
					<div class="col-12  " style="height: 550px; overflow-y: scroll;">
						<table class="table table-striped" id="tabla_usuarios">
							<thead class="text-center">
								<tr>

									<th>Datos</th>
									<th>Muestras</th>
									<th>Tinción Gram</th>
									<th>Técnicas</th>


									<th>Crear</th>
									

								</tr>
							</thead>
							<tbody id="usuario_paciente">

							</tbody>
						</table>

					</div>

				</div>


			</div> 
		</div>


	</div>



	<!-- Modal muestras -->
	<div class="modal fade" id="modal_muestra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Formulario Muestras</h5>

				</div>
				<div id="body_laboratorio" class="px-3">
					<form >
						<input type="hidden" name="m_id_examen" id="m_id_examen">
						<div class="form-group">
							<label class="form-label">Fecha_Recepción</label>
							<input class="form-control"  type="text" name="m_f_recpcion" id="m_f_recpcion" disabled>
						</div>
						<label class="form-label">Fecha Muestra</label>
						<input class="form-control"  type="date" name="m_fecha" id="m_fecha" value="<?php echo date('Y-m-d');  ?>">
						<label class="form-label">Numero de frascos</label>
						<input class="form-control"  type="number" name="m_n_frascos" id="m_n_frascos" value="0">
						<label class="form-label">Resultado</label>
						<!--<input class="form-control"  type="text" name="m_resultado" id="m_resultado">-->
						<select class="form-select" name="m_resultado" id="m_resultado">
							<option>SI</option>
							<option>NO</option>
							
						</select>

					</form>

				</div>
				<div class="modal-footer">

					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cerrar_muestra">Cerrar</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_ing_muestra">Guardar</button>

				</div>
			</div>
		</div>
	</div>

		<!-- Modal tincion gram-->
	<div class="modal fade" id="modal_tincion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">FORMULARIO TINCIÓN GRAM</h5>

				</div>
				<div id="body_laboratorio" class="px-3">
					<form >
						<input type="hidden" name="m_id_muestra" id="m_id_muestra">
					 
						<label class="form-label">Fecha </label>
						<input class="form-control"  type="date" name="g_fecha" id="g_fecha" value="<?php echo date('Y-m-d');  ?>">
						<label class="form-label">Resultado</label>
						<select class="form-select" id="g_resultado">
							<option>NO IDENTIFICADO</option>
							<option>COCOS GRAM POSITIVOS</option>
							<option>COCOS GRAM NEGATIVO</option>
							<option>BACILOS GRAM POSITIVO</option>
							<option>BACILO GRAM NEGATIVO</option>
						</select>
						
						<label class="form-label">Alarma</label>
						<select class="form-select" id="g_alarma">
							<option value="0">NO</option>
							<option value="1">SI</option>
							
						</select>
					</form>


				</div>
				<div class="modal-footer">

					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cerrar_tincion">Cerrar</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_ing_tincion">Guardar</button>

				</div>
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
		$('#submenu_tecnicas').hover(function(){
			$('#id_sumbenu').show();
		}, function(){
			$('#id_sumbenu').hide();

		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			litar_pacientes();
			

			function litar_pacientes(){

				$.ajax({
					url: '../../archivos_php/laboratorio/consultar_pacientes.php',
					type: 'GET',

					success: function(data) {

						let lista_usuario = JSON.parse(data);
						let plantilla = '';
						lista_usuario.forEach(usuario=>{
							plantilla+=`
							<tr class=" " id_lista_usurios = "${usuario.id_pedido_examen}|${usuario.fecha_examen}|${usuario.id_muestra}">

							<td >
							<strong>Código Examen </strong>${usuario.id_pedido_examen}<br>
							<strong>Paciente </strong>${usuario.paciente}<br>
							<strong>Médico </strong>${usuario.medico}<br>
							<strong>Tipo Examen:  </strong>${usuario.tipo_examen}<br>
							<strong>Fecha: </strong>${usuario.fecha_examen}<br>
							</td>`;

							//primer caso, completar - - - el if todos esten vacios if(id_muestra ==null and id_tincion==null and id_tecnicas==null)
							if (usuario.id_muestra == null) {
								plantilla += `
								<td></td>
								<td></td>
								<td></td>
								<td><button class='btn btn-primary btn_modal_muestra mt-3'>Muestra </button></td>
								`;
							}


							if(usuario.resultado=="NO"){
								plantilla += `
								<td>
								<strong>Código Muestra: </strong> ${usuario.id_muestra}<br>
								<strong>Fecha: </strong>${usuario.fecha_muestra}<br>
								<strong>N° Frascos: </strong>${usuario.num_frascos}<br>
								<strong>Resultado: </strong>${usuario.resultado}<br>
								<a class="delete" href="../../archivos_php/laboratorio/eliminar.php?id=${usuario.id_muestra}&proceso=1" class=" "><img src="../../imagenes/delete1.png"/></a>
								</td>
									<td></td>
									<td></td>
									<td>
										Terminado
									</td>
									
								`;
								
							}else{

							//segundo caso  * - - , solo esta llena la primera caja
							if(usuario.id_muestra != null && usuario.id_gram == null){
								plantilla += `
								<td>
								<strong>Código Muestra: </strong> ${usuario.id_muestra}<br>
								<strong>Fecha: </strong>${usuario.fecha_muestra}<br>
								<strong>N° Frascos: </strong>${usuario.num_frascos}<br>
								<strong>Resultado: </strong>${usuario.resultado}<br>
								<a class="delete" href="../../archivos_php/laboratorio/eliminar.php?id=${usuario.id_muestra}&proceso=1" class=" "><img src="../../imagenes/delete1.png"/></a>
								</td>
								<td></td>
								<td></td>
								<td><button class='btn btn-primary btn_modal_tincion mt-3'>Tinción</button></td>
								`;
							}

							
							//tercer caso  * * - , 
							if(usuario.id_gram != null && usuario.id_tecnicas == null ){
								plantilla += `
								<td>
								<strong>Código Muestra: </strong> ${usuario.id_muestra}<br>
								<strong>Fecha: </strong>${usuario.fecha_muestra}<br>
								<strong>N° Frascos: </strong>${usuario.num_frascos}<br>
								<strong>Resultado: </strong>${usuario.resultado}<br>
								<a class="delete" href="../../archivos_php/laboratorio/eliminar.php?id=${usuario.id_muestra}&proceso=1" class=" "><img src="../../imagenes/delete1.png"/></a>
								</td>
								<td>
								<strong>Código Gram: </strong> ${usuario.id_gram}<br>
								<strong>Fecha: </strong>${usuario.fecha_gram}<br>
								<strong>Resultado: </strong>${usuario.resultado_gram}<br>
								<strong>Alarma: </strong>${usuario.alarma}<br>
								<a class="delete" href="../../archivos_php/laboratorio/eliminar.php?id=${usuario.id_gram}&proceso=2" class=" "><img src="../../imagenes/delete1.png"/></a>

								</td>
								<td></td>
								<td>
								<form method="post" action="/iess/vistas/laboratorio/tecnicas">
									<input type="hidden" name="id_tincion" value="${usuario.id_gram}">
									<input type="hidden" name="paciente" value="${usuario.paciente}">
									<button class='btn btn-primary  mt-3'>Técnicas</button>
								</form>
								

								</td>
								`;
							}

							//cuarto caso * * *
							if(usuario.id_tecnicas != null ){
								plantilla += `
								<td>
								<strong>Código Muestra: </strong> ${usuario.id_muestra}<br>
								<strong>Fecha: </strong>${usuario.fecha_muestra}<br>
								<strong>N° Frascos: </strong>${usuario.num_frascos}<br>
								<strong>Resultado: </strong>${usuario.resultado}<br>
								<a class="delete" href="../../archivos_php/laboratorio/eliminar.php?id=${usuario.id_muestra}&proceso=1" class=" "><img src="../../imagenes/delete1.png"/></a>
								</td>
								<td>
								<strong>Código Gram: </strong> ${usuario.id_gram}<br>
								<strong>Fecha: </strong>${usuario.fecha_gram}<br>
								<strong>Resultado: </strong>${usuario.resultado_gram}<br>
								<strong>Alarma: </strong>${usuario.alarma}<br>
								<a class="delete" href="../../archivos_php/laboratorio/eliminar.php?id=${usuario.id_gram}&proceso=2" class=" "><img src="../../imagenes/delete1.png"/></a>

								</td>
								<td>
								<strong>Código tecnicas: </strong> ${usuario.id_tecnicas}<br> <br>

								<label style="cursor:pointer; cursor: hand;" onClick="desplegar('${usuario.id_tecnicas}','estadoT')" ><strong><u>Ver más..[+] </u></strong></label> <br>
								
								`;

								plantilla += `<div id='${usuario.id_tecnicas}' style="display: none;">`;
									if (usuario.id_array != null) {
										plantilla += `<hr>
											<strong>Array</strong> <br>
											<strong>Bacteria: </strong> ${usuario.bacteria_array}<br>
											<strong>Gen_Resistencia: </strong> ${usuario.gen_resistencia}<br>
											<strong>Observación: </strong> ${usuario.observacion_array}<br>

										 `;
									}
									if (usuario.id_antibiograma != null) {
										plantilla += `<hr>
											<strong>Antibiograma</strong> <br>
											<strong>Bacteria: </strong> ${usuario.bacteria_antibiograma}<br>
											<strong>Fenotipo: </strong> ${usuario.fenotipo}<br>
											<strong>Reporte: </strong> ${usuario.reporte}<br>
											<strong>Observación: </strong> ${usuario.observacion_antibiograma}<br>`;


									}
									if (usuario.id_eplex != null) {
										plantilla += `<hr>
											<strong>Eplex</strong> <br>
											<strong>Bacteria: </strong> ${usuario.bacteria_eplex}<br>
											<strong>Reporte: </strong> ${usuario.mec_resistencia}<br>
											<strong>Observación: </strong> ${usuario.observacion_eplex}<br>
											`;
				
									}

									plantilla += "</div>";



								plantilla += `
								<a class="delete" href="../../archivos_php/laboratorio/eliminar.php?id=${usuario.id_tecnicas}&proceso=3" class=" "><img src="../../imagenes/delete1.png"/></a>
										</td>
												<td>
												<label>Terminado</label>
												</td>`;
							}


						}
							

							plantilla += `</tr>`;

						});
						$('#usuario_paciente').html(plantilla);
					}



				});

			}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){


			$("#buscar_paciente").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#usuario_paciente tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
	</script>

	<!-- ///////////////INGRESAR MUESTRA//////////////////////////////-->

	<script type="text/javascript">
		$(document).on('click','.btn_modal_muestra',function(e){
			e.preventDefault();
			let elemento = $(this)[0].parentElement.parentElement;
			let id=$(elemento).attr('id_lista_usurios');
			let my_id = id.split("|");

			$('#m_id_examen').val(my_id[0]);
			$('#m_f_recpcion').val(my_id[1]);
			

			$('#modal_muestra').modal("show");

		}); 

		$(document).on('click','#btn_cerrar_muestra',function(e){
			$('#modal_muestra').modal("hide");
		});
		

	</script>


	<script type="text/javascript">
		//ingresar muestra

		$(document).on('click','#btn_ing_muestra',function(e){
			e.preventDefault();

			var data_form={
					id_examen:$('#m_id_examen').val(),
					f_recepcion:$('#m_f_recpcion').val(),
					fecha:$('#m_fecha').val(),
					n_frascos:$('#m_n_frascos').val(),
					resultado:$('#m_resultado').val()
				}
				$.post('../../archivos_php/laboratorio/ingresar_muestra.php', data_form, function(data) {
					console.log(data)
					if (data=="ok") {
						succes_refresh("Datos Guardados",'../../vistas/laboratorio/ver_pacientes');
					}else {
						erro_message("Error no se guardó");
					}
				});
			
			

		}); 

	</script>

<!-- ///////////////INGRESAR TINCION//////////////////////////////-->


	<script type="text/javascript">
		$(document).on('click','.btn_modal_tincion',function(e){
			e.preventDefault();
			let elemento = $(this)[0].parentElement.parentElement;
			let id=$(elemento).attr('id_lista_usurios');
			let my_id = id.split("|");


			$('#m_id_muestra').val(my_id[2]);
			

			$('#modal_tincion').modal("show");

		}); 

		$(document).on('click','#btn_cerrar_tincion',function(e){
			$('#modal_tincion').modal("hide");
		});
		

	</script>


	<script type="text/javascript">
		//ingresar tincion

		$(document).on('click','#btn_ing_tincion',function(e){
			e.preventDefault();

			var data_form={
					id_muestra:$('#m_id_muestra').val(),
					g_fecha:$('#g_fecha').val(),
					g_resultado:$('#g_resultado').val(),
					g_alarma:$('#g_alarma').val(),
					
				}
				$.post('../../archivos_php/laboratorio/ingresar_gram.php', data_form, function(data) {
					console.log(data)
					if (data=="ok") {
						succes_refresh("Datos Guardados",'../../vistas/laboratorio/ver_pacientes');
					}else {
						erro_message("Error no se guardó");
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

	<script type="teXt/javascript">
		$(document).on('click','.delete',function(e){
			//e.preventDefault();
			if (confirm("Seguro desea eliminar?") == false) {
					return false;
			}

	})
	</script>


</body>
</html> 