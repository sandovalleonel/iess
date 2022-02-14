
function succes_refresh(mensaje,url){
	Swal.fire({
		icon: 'success',
		title: mensaje,
		showConfirmButton: false,
		timer: 2500
	});

	setTimeout(function(){
		$(location).attr('href', url);
	}, 2000);
}


function erro_message(mensaje){
	Swal.fire({
		icon: 'error',
		title: mensaje,
		showConfirmButton: false,
		timer: 2500
	});	
}

function succes_message(mensaje){
	Swal.fire({
		icon: 'success',
		title: mensaje,
		showConfirmButton: false,
		timer: 2500
	});

}