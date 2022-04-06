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
	<title>Alertas</title>
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

	<div class="row">
		<?php
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar_diagnostico.php");
		//echo $navbar_diagnostico; 
		include("menu_alertas.php");
		
		?>

		<div class="col-1">	</div>

		<div class="col-xs-12 col-md-7  mt-5 shadow " >
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">MIS ALERTAS</button>
				</li>


			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

					<div class="col-5 pb-3 pt-3">
						<input type="text" id="buscar_paciente" class="form-control rounded" placeholder="Buscar" aria-label="Search"
						aria-describedby="search-addon" />
					</div>
					<div class="col-12  " style="height: 250px; overflow-y: scroll;">
						<table class="table table-bordered text-center" id="tabla_usuarios">
							<thead>
								<tr>
									<th>PACIENTE</th>
									<th>COD</th>
									<th>RESUMEN</th>
									 
								 
									

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

	<!-- Modal -->
<div class="modal fade" id="modal_resumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       
        <h5 class="modal-title text-center d-block  " id="exampleModalLabel">RESUMEN</h5>
     
      <div class="modal-body" id="mi_modal_body">
      	<pre id="mi_p_modal">
      		
      	</pre>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  id="btn_modal" data-dismiss="modal">Close</button>
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
		//mostrar la tabla
 	litar_notificaciones();
			
	

			function litar_notificaciones(){
				$.ajax({
					url: '../../archivos_php/notificaciones/notificar_a_diagnostico.php',
					type: 'GET',
					success: function(data) { 

						let lista_usuario = JSON.parse(data);
						let plantilla = '';
						lista_usuario.forEach(usuario=>{
							plantilla+=`
							<tr id_lista_usurios="${usuario.id_notificacion}">

							<td>${usuario.paciente}</td>
							<td>${usuario.cod_examen} </td>`;

							if ((usuario.estado)==0) {
								plantilla+="<td><button type='button' class='btn btn-success btn_list'>VER</button></td>";
							}else{
								plantilla+="<td><button type='button' class='btn btn-secondary btn_list'>REVISADO</button </td>";
							}
 
							 plantilla+="</tr>";
						});
						$('#usuario_paciente').html(plantilla);
					}
				});
			}
	</script>
	<script type="text/javascript">
		//buscador en la tabla
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
			 
 			  
           $.post('../../archivos_php/notificaciones/consultar_resumen.php', {id_notificacion:id}, function(data) {
           		 
           		$('#modal_resumen').modal('show');
           		$('#mi_p_modal').text(data);
           		mostrar_alertas();
           });
           $.post('../../archivos_php/notificaciones/notificacion_vista.php', {id_notificacion:id}, function(data) {
           			console.log(data);
           			 
           			 litar_notificaciones();
           });

          

		});
	</script>


	<script type="text/javascript">
		//listar todas las alertas
		mostrar_alertas();
		function mostrar_alertas(){
			//contador de laertas
			$.ajax({
					url: '../../archivos_php/notificaciones/total_notificaciones.php',
					type: 'GET',
					success: function(data) {

						 //if (data>0) {
						 	$('#id_alertas_navbar').text('ALERTAS ('+data+')');

						 //}
					}
				});
		}
	</script>

	<script type="text/javascript">
		$(document).on('click', '#btn_modal', function(event) {
			event.preventDefault();
			$('#modal_resumen').modal('hide');

		});
	</script>
</body>
</html>