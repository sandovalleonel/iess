
algo = """
 <div class="col-xs-12 col-md-2 ">
 			<nav class="navbar bg-primary border-top d-block">
 				<ul class="nav navbar-nav">
                    <li class="nav-item border-bottom menu">
                        <a href="/iess/vistas/diagnostico/agregar_paciente" class="nav-link text-white">&nbsp;<label>AGREGAR PACIENTE</label></a>
                    </li>
 					<li class="nav-item border-bottom menu">
 						<a href="/iess/vistas/diagnostico/diagnostico" class="nav-link text-white ">&nbsp;DIAGNOSTICO</a>
 					</li>
 					 
  					<li class="nav-item border-bottom menu">
 						<a href="/iess/vistas/diagnostico/prescripcion_medica" class="nav-link text-white">&nbsp;PRESCRIPCION MEDICA</a>
 					</li>
 					 

                    <li class="nav-item border-bottom menu">
                        <a href="/iess/vistas/diagnostico/resumen_diagnostico" class="nav-link text-white">&nbsp;RESUMEN</a>
                    </li> 
 														
 				</ul>
 				
 			</nav>
 			
 		</div>
"""
algo = algo.encode('utf-8').decode('latin-1')
print(algo)