Swal.fire({
	title: 'Nuevo Paciente en camino',
	text: 'Debe Aceptar o rechazar al paciente',
	icon: 'info',
	position: 'top-end',
	//toast: true,
	//html: '<button>Aceptar</button>',
	buttons: true,
	//dangerMode: true,
})
.then((willDelete) => {
	if(willDelete) {
		swal("La confirmacion fue enviada",{
			icon: "success",
		});
	} else {
		swal("Se elimino de la lista al paciente");
	}
});