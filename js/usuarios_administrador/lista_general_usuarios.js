$(document).ready(function(){

 litar_usuarios();
	//eliminar usuarios
	$(document).on('click','.delete_user',function(){
		Swal.fire({
			title: 'Está seguro?',
			text: "Eliminar usuario!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si ',
			cancelButtonText: 'Cancelar'

		}).then((result) => {
			if (result.isConfirmed) {
				let elemento = $(this)[0].parentElement.parentElement;
				let id=$(elemento).attr('id_lista_usurios');
				$.post('/iess/archivos_php/usuarios_administrador/delete_user.php',{id},function(response){
					//console.log(response);
				 //listar nuevamente
				 litar_usuarios();

				});
			}
		})

		
	});




	function litar_usuarios(){

		$.ajax({
		  url: '/iess/archivos_php/usuarios_administrador/consultar_usuarios_sistema.php',
		  type: 'GET',
		   
		  success: function(data) {
		  	//console.log(data);
		    let lista_usuario = JSON.parse(data);
		    let plantilla = '';

		    lista_usuario.forEach(usuario=>{
		    	plantilla+=`

		    		<tr id_lista_usurios="${usuario.id}">
		    		 
		    			<td>${usuario.nombre}</td>
		    			<td>${usuario.usuario}</td>
		    			<td>${usuario.cargo}</td>
		    			
		    			<td> <button class="btn btn-info update_user">Editar</button> </td>
		    			<td> <button class="btn btn-danger delete_user">Eliminar</button> </td>
		    		</tr>
		    	`;
		    });
		    $('#usuario_admin').html(plantilla);
		  }

		 

		});
 
	}


	///actualizar clave
/*
	$(document).on('click','.update_user',async function(){
		let elemento = $(this)[0].parentElement.parentElement;
		let id=$(elemento).attr('id_lista_usurios');

		const { value: text } = await  Swal.fire({
			input: 'text',
			inputLabel: 'Acutualizar contraseña',
			inputPlaceholder: 'Nueva contraseña',
			inputAttributes: {
				'aria-label': 'Type your message here'
			},
			showCancelButton: true
		})

		if (text) { 
			
			alert(text,id);
		}
	});
*/

	///////saber si una tabla esta vasia

	function existen_registros (tabla) {
		let filas = $(tabla).find('tbody tr').length;

		if(filas > 0) {
			return 1;
		}
		else {
			return 0;
		}
	}


 
});