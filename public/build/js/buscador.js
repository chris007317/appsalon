document.addEventListener('DOMContentLoaded', function(){
	iniciarApp();
});

function iniciarApp(){
	buscarFecha();

}

function buscarFecha(){
	const fecha = document.querySelector('#dateFecha');
	fecha.addEventListener('input', function(event){
		const fechaBuscar = event.target.value;
		window.location = `?fecha=${fechaBuscar}`;
	});
}