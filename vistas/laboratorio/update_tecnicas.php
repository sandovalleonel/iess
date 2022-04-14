<?php
session_start();
$usuario = $_SESSION['username'];
if (!isset($usuario)){
	header("location: ../../index.php");
}

date_default_timezone_set('America/Guayaquil');


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Técnicas</title>
	<link rel="icon" href="../../imagenes/favicon.png">
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
		include("menu.php");
		?>


		<div class="col-1">	</div>
		<!-- div*****************************************-->
        
    
		<div class="col-xs-12 col-md-6  mt-5 shadow"  >
             <input type="hidden" id="id_tecnicas" value="<?php echo $_GET['id_tecnicas']; ?>" />
            <div class="d-flex flex-row justify-content-end alig-items-end">
                <a class="btn btn-danger mt-4 " href="ver_pacientes">Salir</a>
            </div>
            
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item " role="presentation" >
					<button class="nav-link active" id="tecnica1-tab" data-bs-toggle="tab" data-bs-target="#tecnica1" type="button" role="tab" aria-controls="tecnica1" aria-selected="true">Biología Molecular Film Array</button>
				</li>
				<li class="nav-item active" role="presentation" >
					<button class="nav-link" id="tecnica2-tab" data-bs-toggle="tab" data-bs-target="#tecnica2" type="button" role="tab" aria-controls="tecnica2" aria-selected="false">Antibiograma</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="tecnica3-tab" data-bs-toggle="tab" data-bs-target="#tecnica3" type="button" role="tab" aria-controls="tecnica3" aria-selected="false">Biología Molecular Eplex</button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active array" id="tecnica1" role="tabpanel" aria-labelledby="tecnica1-tab">

					<!-- tec1*+++++++++++++++++++++++++++++++-->


					<hr>
					<div class="container " id="div_array">
						<form id="form_array" >


						<div class="form-group">
							<label for="exampleInputEmail1"> Bacteria</label>
							<select class="form-select" id="bacteria_array" name="bacteria_array">
								<?php
									include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/laboratorio/cargar_bacteria.php");
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Gen Resistencia</label>
							<select class="form-select" id="gen_resistencia_array" name="gen_resistencia_array">
								<option>NINGUNO</option>
								<option>NO APLICA</option>
								<option>CTX-M</option>
								<option>KPC</option>
								<option>NDM</option>
								<option>MecA/C</option>
								<option>MecA/C - MREJ</option>
								<option>Oxa-48</option>
								<option>mcr-1</option>
								<option>VanA</option>
								<option>VanB</option>
								<option>VIM</option>
								<option>IMP</option>
							</select>
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1">Observación</label>
							<input type="text" class="form-control" id="observacion_array" name="observacion_array">
						</div>
						<div class="col text-center">
						<input type='button' value='Actualizar' id='btn_bmf' class="btn btn-primary my-3">					
						 
					</div>
					</form>

				</div>

				<!-- tec1*+++++++++++++++++++++++++++++++-->
			</div>
			<div class="tab-pane fade" id="tecnica2" role="tabpanel" aria-labelledby="tecnica2-tab">
				<!-- tec2*+++++++++++++++++++++++++++++++-->

				<hr>
				<div class="container " id="div_antibiograma">

					<form   id="form_antibiograma">

					<div class="form-group">
						<label for="exampleInputEmail1"> Bacteria</label>
						<select class="form-select" id="bacteria_antibiograma" name="bacteria_antibiograma">
							<?php
									include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/laboratorio/cargar_bacteria.php");

								?>
						</select>
						
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Fenotipo</label>
						<select class="form-select" id="fenotipo_antibiograma" name="fenotipo_antibiograma">
							<option>NINGUNO</option>
							<option>NO APLICA</option>
							<option> BLEE </option>
							<option> AmpC </option>
							<option> Carbapenemasa no identificada </option>
							<option> Carbapenemasa KPC </option>
							<option> Carbapenemasa VIM </option>
							<option> Carbapenemasa IMP </option>
							<option> Carbapenemasa NDM </option>
							<option> Carbapenemasa OXa-48 like </option>
							<option> Resistencia a los carbapenémicos no enzimático </option>
							<option> Resistencia a la colistina </option>
							<option> Resistencia a la oxacilina </option>
							<option> Resistencia a la clindamicina </option>
							<option> Resistencia a la Vancomicina </option>
							<option> Resistencia a la gentamicina de alta carga </option>

						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Reporte Acorde a Guia</label>
						<select class="form-select" id="reporte_antibiograma" name="reporte_antibiograma">
							<option>NO</option>
							<option>SI</option>
							
						</select>
					</div>



					<div class="form-group">
						<label for="exampleInputEmail1">Observación</label>
						<input type="text" class="form-control" id="observacion_antibiograma" name="observacion_antibiograma">
					</div>
					<div class="col text-center">
						<input type='button' value='Actualizar' id='btn_antibiograma' class="btn btn-primary my-3">
					
					
				</div>
				</form>	
			</div>
			<!-- tec2*+++++++++++++++++++++++++++++++-->
		</div>
		<div class="tab-pane fade" id="tecnica3" role="tabpanel" aria-labelledby="tecnica3-tab">
			<!-- tec3*+++++++++++++++++++++++++++++++-->

			<hr>
			<div class="container " id="div_eplex">

				<form id="form_eplex" >

				<div class="form-group">
					<label for="exampleInputEmail1">Bacteria</label>
					<select class="form-select" id="bacteria_eplex" name="bacteria_eplex">
						<?php
									include( $_SERVER['DOCUMENT_ROOT']."/iess/archivos_php/laboratorio/cargar_bacteria.php");

								?>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Mec Resistencia</label>
					<select class="form-select" id="resistencia_eplex" name="resistencia_eplex">
						<option>NINGUNO</option>
						<option>NO APLICA</option>
						<option>CTX-M</option>
						<option>KPC</option>
						<option>NDM</option>
						<option>MecA/C</option>
						<option>MecA/C - MREJ</option>
						<option>Oxa-48</option>
						<option>mcr-1</option>
						<option>VanA</option>
						<option>VanB</option>
						<option>VIM</option>
						<option>IMP</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Observación</label>
					<input type="text" class="form-control" id="observacion_eplex" name="observacion_eplex">
				</div>
				<div class="col text-center">
				<input type='button' value='Actualizar' id='btn_bme' class="btn btn-primary my-3">
				<!--<a href="/iess/vistas/laboratorio/ver_pacientes" class="btn btn-danger" onclick="verificar_salir()">Finalizar y Salir</a>-->
				 
				
			</div>
			</form>
		</div>
		<!-- tec3*+++++++++++++++++++++++++++++++-->
	</div>

		
</div> 

</div>
<!-- div*****************************************-->





</div>
<?php 
echo $footer;
?>

<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../../js/b_js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="../../js/mensaje_general.js"></script>


 


<script type="text/javascript">
    var id_array = "";
    var id_eplex = "";
    var id_antibiograma = "";
    var id_tecnicas = "";
autocompletar();
            //ingresar eplex
        function autocompletar(){
                id_tecnicas = $('#id_tecnicas').val();
                $.post('../../archivos_php/laboratorio/consultar_datos_tecnicas.php',{'id_tecnicas':$('#id_tecnicas').val()}, function(data) {
                    
                    let tecnicas = JSON.parse(data);
                    //console.log(tecnicas)
            		tecnicas.forEach(el=>{
                            if(el.id_array != null){
                                id_array = el.id_array ;
                                el.array.forEach(ind=>{
                                    $('#bacteria_array').val(ind.id_bacteria);
                                    $('#gen_resistencia_array').val(ind.resistencia);
                                    $('#observacion_array').val(ind.observacion);
                                })
                                


                            }
                            if(el.id_antibiograma != null){
                                id_antibiograma = el.id_antibiograma;
                                el.antibiograma.forEach(ind=>{
                                    $('#bacteria_antibiograma').val(ind.id_bacteria);
                                    $('#fenotipo_antibiograma').val(ind.fenotipo);
                                    $('#reporte_antibiograma').val(ind.reporte);
                                    $('#observacion_antibiograma').val(ind.observacion);
                                });
                            }
                            if(el.id_eplex != null){
                                id_eplex = el.id_eplex;
                                el.eplex.forEach(ind=>{
                                    $('#bacteria_eplex').val(ind.id_bacteria);
                                    $('#resistencia_eplex').val(ind.resistencia);
                                    $('#observacion_eplex').val(ind.observacion);
                                });
                            }
                        })
                    
                });
        }
		


	</script>

	<script type="text/javascript">
		//ingresar tecnica array
		$(document).on('click', '#btn_bmf', function(event) {
			event.preventDefault();
            var data_form = $('#form_array').serialize() ;
            data_form+=`&id_array=${id_array}&id_tecnicas=${id_tecnicas}`;
            //console.log(data_form);

            $("#form_array").css({display: "none"});
            $("#div_array").append("<h3 class='py-4'>Técnica Film Array Actualizada</h3>");
			 
			$.post('../../archivos_php/laboratorio/update_tecnica_array.php', data_form, function(data) {
				console.log(data)
				 
				if (data=="ok") {
					succes_message("Creado correctamente");
				}else{
					erro_message("Error al ingresar");
				}
			});
			

		});

	</script>


	<script type="text/javascript">
            //ingresar antibiograma
		$(document).on('click', '#btn_antibiograma', function(event) {
			event.preventDefault();
            var data_form = $('#form_antibiograma').serialize() ;
            data_form+=`&id_antibiograma=${id_antibiograma}&id_tecnicas=${id_tecnicas}`;
			 //console.log(data_form)
             $("#form_antibiograma").css({display: "none"});
             $("#div_antibiograma").append("<h3 class='py-4'>Técnica Antibiograma Actualizada</h3>");
            
			$.post('../../archivos_php/laboratorio/update_tecnica_antibiograma.php', data_form, function(data) {	
				if (data=="ok") {
					succes_message("Creado correctamente");
				}else{
					erro_message("Error al ingresar");
				}
			});

		});
		

	</script>



	<script type="text/javascript">

            //ingresar eplex
            $(document).on('click', '#btn_bme', function(event) {
                event.preventDefault();
                var data_form = $('#form_eplex').serialize() ;
                data_form+=`&id_eplex=${id_eplex}&id_tecnicas=${id_tecnicas}`;
                //console.log(data_form )
                $("#form_eplex").css({display: "none"});
                $("#div_eplex").append("<h3 class='py-4'>Técnica Eplex Actualizada</h3>");
                
                $.post('../../archivos_php/laboratorio/update_tecnica_eplex.php', data_form, function(data) {
                    console.log(data)
                    if (data=="ok") {
                        succes_message("Creado correctamente");	
                    }else{
                        erro_message("Error al ingresar");
                    }
                });
            });
		


	</script>




	
</body>
</html>