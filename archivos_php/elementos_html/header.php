<?php

 echo '<header>
		<nav class="navbar navbar-dark bg-primary  w-100">
			<div class="container-fluid" >
				<a href="/iess/index" class="  " ><img width="50px" src="/iess/imagenes/home.png"/></a>
				<a href="/iess/index" class=" position-absolute m-lg-5"><img width="120px" src="/iess/imagenes/logo.jpg"/></a>
				 
				<h3 class="text-white">';
				echo "Médico. ";
				echo $usuario;
				echo '</h3>
				<form action="/iess/archivos_php/login/salir.php">
					<button class="btn btn-primary  shadow  border-bottom-0 " style="height: 30px; width: 135px">
					<strong>
					Cerrar Sesión
					</strong>
					</button>
				</form>
			</div>
			
		</nav> 
	</header>';
 

?>


 