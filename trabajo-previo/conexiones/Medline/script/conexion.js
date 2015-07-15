
$(function() {

// creamos las variables que vayamos a ir necesitando
// comenzamos capturando el botón que lanza la búsqueda
var $contenido = $('.ampliar');
// código para mostrar zonas ocultas
$contenido.on('click', function () {
	// se toma como referencia el elemento sobre el que se hace clic
	// con él, se identifican el resto de elementos siguientes HASTA QUE ENCUENTRA el siguiente enlace de título
	$(this).nextUntil('.ampliar').toggleClass('oculto');
});

});
