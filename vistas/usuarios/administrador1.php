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
	<title>Administrador</title>
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
<body class="bg-light">
	

	<?php
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/header.php");
		 
	?>

	<div class="row ">
		<?php
		include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/elementos_html/navbar.php");
		//echo $navbar_usuarios; 
		include("menu.php");
		?>

		<!-- Formulario 1*****************************************-->
		<div class="col-xs-12 col-md-3  mt-2 shadow bg-white"  >

			<div class="container-fluid ">
				
				<div class="row pt-3" >	
					<h4 class="text-center" > CREAR USUARIO</h4>
					<div class="container">
						<form  method="post" id="administrador1_form">

							<input type="hidden" name="id_personal" id="id_personal">
							<div>
								<label class="form-label">CI</label>
								<input class="form-control" type="number" name="administrador1_ci" id="administrador1_ci"  >
							</div>
							<div>
								<label class="form-label">Categoría</label>
								<input class="form-control" type="text" name="administrador1_categoria" id="administrador1_categoria" disabled>
							</div>
							<div>
								<label class="form-label">Usuario</label>
								<input class="form-control" type="text" name="administrador1_usuario" id="administrador1_usuario" disabled>
							</div>
							<div>
								<label class="form-label">Contraseña</label>
								<input class="form-control" type="text" name="administrador1_contrasenia" id="administrador1_contrasenia">
							</div>
							<div class="col text-center">
							<button class="btn btn-primary my-3 " >Guardar</button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 ">
			  
			<div class="col-5 pb-3 pt-3">
				<input type="text" id="buscar_admin" class="form-control rounded" placeholder="Buscar" aria-label="Search"
				aria-describedby="search-addon" />
			</div>
			<div class="col-12" style="height: 400px; overflow-y: scroll;">
				<table class="table table-bordered text-center">
					<thead>
						<tr>
							<th>Id</th>
							<th>CÉDULA</th>
							<th>NOMBRES</th>
							<th>CÓDIGO AS400</th>
							<th>CARGO</th>
							<th></th>
						</tr> 
					</thead>
					<tbody id="lista_general_usuario">
						 <?php
						 	include "../../archivos_php/usuarios_administrador/consultar_lista_general.php";
						 ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
		<?php 
	echo $footer;
	?>

	<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="../../js/sweetalert2.all.min.js"></script>
	 
	<script type="text/javascript">
		$(document).ready(function(){

			////add user
			$(document).on('click', '.agregar_usuario', function() {

					
					if ($(this).val()=='agregado') {
						Swal.fire({
						  icon: 'warning',
						  title: 'El usuario ya esta en el sistema!',
						  showConfirmButton: true,
						 
						});
						return;
					}

					
					let elemento = $(this)[0].parentElement.parentElement;
					let id=$(elemento).attr('id_lista_general');
			 
					var valores = "", id_personal = "";
			        
			        $(this).parents("tr").find("#numero").each(function() {
			        	valores += $(this).html() + "\n";
			        });
			        $(this).parents("tr").find("#id_personal").each(function() {
			        	id_personal += $(this).html() + "\n";
			        });
			         
			        //alert(id+" " +id_personal);
			        $('#administrador1_ci').val(id);
			        $('#administrador1_categoria').val(valores);
			        $('#administrador1_usuario').val(id);
			        $('#administrador1_contrasenia').val(id);
			        $('#id_personal').val(id_personal);




			});

			////insert user

			$('#administrador1_form').submit(function(e){
				var user=$.trim($('#administrador1_ci').val());
				var pass=$.trim($('#administrador1_contrasenia').val());
				if(user.length<1 || pass.length<1)
					return;
				
				e.preventDefault();
				const data_form = {
					id : $('#id_personal').val(),
					usuario:$('#administrador1_usuario').val(),
					clave:$('#administrador1_contrasenia').val()

				};
				$.post('../../archivos_php/usuarios_administrador/insertar_usuarios_sistema.php',data_form,function(response){
					console.log(response+"  __");
					if(response=='ok'){
						Swal.fire({
						  icon: 'success',
						  title: 'Usuario agregado con exito',
						  showConfirmButton: false,
						  timer: 2500
						});
						 
						setTimeout(function(){
							$(location).attr('href', '../../vistas/usuarios/administrador1');
						}, 2000);
						
						 
					}
						
					else{
						Swal.fire({
						  icon: 'error',
						  title: 'Error al guardar',
						  showConfirmButton: false,
						  timer: 2500
						});
					}
				});

			});

		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#administrador1_form').validate({
				rules:{
					administrador1_ci:{
						required:true,
						minlength:10,
						maxlength:10
					},
					 
					administrador1_contrasenia:{
						required:true

					}


				},
				messages:{
					administrador1_ci:{
						required:"Campo vacío",
						minlength:"Digíte 10 números",
						maxlength:"Maximo 10 números"
					},
					administrador1_contrasenia:{
						required:"Campo vacío"

					}

				}

			});

		});
	</script>

	<script type="text/javascript">
		 
			$("#buscar_admin").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#lista_general_usuario tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		
			 
	</script>
</body>
</html>