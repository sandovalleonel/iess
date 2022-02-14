algo = """
 <div class="col-xs-12 col-md-2">
 			<nav class="navbar bg-primary border-top d-block">
 				<ul class="nav navbar-nav">
 					<li class="nav-item border-bottom menu">
 						<a href="/iess/vistas/laboratorio/ver_pacientes" class="nav-link text-white">&nbsp;MIS PACIENTES</a>
 					</li>
 					<li class="nav-item border-bottom menu">
 						<a href="/iess/vistas/laboratorio/muestras" class="nav-link text-white">&nbsp;MUESTRAS</a>
 					</li>
 					<li class="nav-item border-bottom menu">
 						<a href="/iess/vistas/laboratorio/tincion_gram" class="nav-link text-white">&nbsp;TINCION DE GRAM</a>
 					</li>
 					<li class="nav-item border-bottom menu">
 						<a href="/iess/vistas/laboratorio/tecnicas" class="nav-link text-white">&nbsp;TECNICAS</a>
 					</li>
 					
 				</ul>
 				
 			</nav>
 			
 		</div>
"""
algo = algo.encode('utf-8').decode('latin-1')
print(algo)