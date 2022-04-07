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

</head>
<body class="bg-light">
	

	<div class="container-fluid">
		<div class="row">
			<div class="col-12 my-4"> 
				<div class="d-inline-block">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<button type="submit" id="DLtoExcel" name='DLtoExcel' value="Export to excel" class="btn btn-primary">Exportar  excel</button>
					</form>
				</div>

				<div class="d-inline-block mx-5">
					<form action="../../perfiles" method="post">
						<button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-primary">Regresar</button>
					</form>
				</div>

			</div>
			<div class="col-12 ">



				<table class="table border default">
					<thead>
						<tr>
							<?php 
							$cabecera = array( "Paciente","Médico_Diagnóstico","Id_diagnostico","Enfermedad1",
					"Enfermedad2","Comentario_diagnóstico","Fecha_diagnóstico",
					"id_prescipción","antibiótico1","dosis1","antibiótico2(opcional)",
					"dosis2(opcional)","antibiótico3(opcional)","dosis3(opcional)",
					"fecha_inicio","tiempo(dias)","fecha_fin","escala","mantiene","descala",
					"ajuste_dosis","id_examen","tipo_examen","fecha_examen","id_muestra",
					"Médico_laboratorio","fecha","numero_frascos","Resultado","id_tinción","fecha_tinción",
					"Resultado_tinción","alarma","id_técnicas","bacteria_array","id_array",
					"gen_resistencia","fecha_array","observación_array","bacteria_antibiograma",
					"id_antibiograma","fenotipo","fecha_antibiograma","reporte",
					"observación_antibiograma","bacteria_eplex","id_eplex","mec_resistencia",
					"fecha_explex","observación_eplex"
				);



							for ($i=0; $i < sizeof($cabecera) ; $i++) { 
								echo "<th>$cabecera[$i]</th>";
							}

							?>


							
						</tr>
					</thead>
					<tbody id="ver_historial">


					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="../../js/excelexportjs.js"></script>

	<script type="text/javascript">
		
		$(document).ready(function(){
			imprimir();

			function imprimir(){
				
				$.get('../../archivos_php/diagnostico/resumen.php', function(response) {
					console.log(response)
					data = JSON.parse(response);

					plantilla = "";
					
					data.forEach(obj => {
								plantilla += "<tr>";

								Object.entries(obj).forEach(([key, value]) => {
									plantilla += `<td>${value}</td>`;
									//console.log(`${key} ${value}`);
								});
								plantilla += "<tr>";
								//console.log('-------------------');
					});

					$('#ver_historial').html(plantilla);
					
				})
			}


							
		
		})


	</script>

	<script>


		$(document).on('click', '#DLtoExcel', function(e) {	
			e.preventDefault();
			$.get('../../archivos_php/export_data/consulta_global.php', function(response) {
				let data = JSON.parse(response);
				$("#dvjson").excelexportjs({
					containerid: "dvjson"
					, datatype: 'json'
					, dataset: data
					, columns: getColumns(data)     
				});

			});


		});




	</script>

</body>
</html>
