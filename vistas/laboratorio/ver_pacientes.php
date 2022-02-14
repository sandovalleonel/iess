<?php
session_start();
$usuario = $_SESSION['username'];
if (!isset($usuario)){
	header("location: ../../index.php");
}
///destrir variables del laboratorio si existen

	unset($_SESSION['l_s_id_diagnostico']); 
	unset($_SESSION['l_s_id_paciente']); 
	unset($_SESSION['l_s_id_medico']); 
	unset($_SESSION['l_s_id_pedido_examen']); 
	unset($_SESSION['l_s_paciente']); 
	unset($_SESSION['l_s_medico']); 
	unset($_SESSION['l_s_diagnostico']);
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
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar.php");
		//echo $navbar_laboratorio; 
		$python = `python3 menu.py`;
		echo $python; 
		?>


			
		<div class="col-xs-12 col-md-9  mt-5 shadow " >

			

			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Pacientes</button>
				</li>


			</ul>
			<div class="tab-content " id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

					<div class="col-5 pb-3 pt-3">
						<input type="text" id="buscar_paciente" class="form-control rounded" placeholder="Buscar" aria-label="Search"
						aria-describedby="search-addon" />
					</div>
					<div class="col-12  " style="height: 250px; overflow-y: scroll;">
						<table class="table table-bordered text-center" id="tabla_usuarios">
							<thead>
								<tr>
									<th>Cod Diagnóstico</th>
									<th>Cod Prescripcion</th>
									<th>Diagnostico</th>
								 
									<th>Paciente</th>
								 
									<th>Doctor</th>
									<th>Fecha de examen</th>
									

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
	<?php 
	echo $footer;
	?>

 

	<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/iess/js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="/iess/js/jquery.validate.min.js"></script>
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
		$(document).ready(function(){

			litar_pacientes();
			
 
			function litar_pacientes(){

				$.ajax({
					url: '/iess/archivos_php/laboratorio/consultar_pacientes.php',
					type: 'GET',

					success: function(data) {
						 
						let lista_usuario = JSON.parse(data);
						let plantilla = '';
						lista_usuario.forEach(usuario=>{
							plantilla+=`

							<tr id_lista_usurios="${usuario.id_pedido_examen}">
							<td>${usuario.id_diagnotico}</td>
							<td>${usuario.id_prescripcion}</td>

							<td>${usuario.diagnostico} </td>
					 
							<td>${usuario.paciente}</td>
					 
							<td>${usuario.medico}</td>
							<td>${usuario.fecha_examen}</td>
							<td><button class='btn btn-primary btn_list'>Seleccionar</button></td>
							</tr>
							`;
						});
						$('#usuario_paciente').html(plantilla);
					}


 
				});

			}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#buscar_doctor").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#usuario_doctor tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
			

			$("#buscar_paciente").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#usuario_paciente tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).on('click','.btn_list',function(e){
			let elemento = $(this)[0].parentElement.parentElement;
			let id=$(elemento).attr('id_lista_usurios');
 
			var valores=[];

			valores.push(id);
            $(this).parents("tr").find("td").each(function(){
                valores.push($(this).html());
            });

 
           $.post('/iess/archivos_php/laboratorio/crear_sessiones_laboratorio.php', {'array_data': JSON.stringify(valores)}, function(data) {
           		
           		$(location).attr('href', '/iess/vistas/laboratorio/muestras')

           });
		});
	</script>


</body>
</html>