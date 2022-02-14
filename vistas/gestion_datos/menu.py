algo = """

<div class="col-xs-12 col-md-2 ">
 			<nav class="navbar bg-primary border-top d-block">
 				<ul class="nav navbar-nav">
 					<li class="nav-item border-bottom menu">
 						<a href="/iess/vistas/gestion_datos/agregar_paciente" class="nav-link text-white">&nbsp;AGREGAR PACIENTE</a>
 					</li>
 					<li class="nav-item border-bottom menu">
 						<a href="/iess/vistas/gestion_datos/agregar_medico" class="nav-link text-white">&nbsp;AGREGAR MEDICO</a>
 					</li>
 					<li class="nav-item border-bottom menu">
 						<a href="/iess/vistas/gestion_datos/ver_personas" class="nav-link text-white">&nbsp;VER</a>
 					</li>
 				</ul>
 			</nav>
 		</div>
"""
algo = algo.encode('utf-8').decode('latin-1')
print(algo)