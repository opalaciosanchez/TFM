$(function() {

// creamos las variables que vayamos a ir necesitando
// comenzamos capturando el botón que lanza la búsqueda
var $buscar = $('#buscar');
// capturamos el dato del formulario
var $palabra = $('#palabra').val();
// URL base de la consulta
var $URL = 'http://www.zaragoza.es/buscador/select?';

$buscar.on('click', function () {
	$.ajax({
		type: 'GET',
		url: $URL,
		// insertamos las variables que realizan la consulta. ATENCIÓN A LOS ESPACIOS entre elementos
		data: {'wt':'json', 'q':'title:' + $palabra + ' text:' + $palabra + ' AND -tipocontenido_s:estatico AND category:Asociaciones'},
		success: function(data) { 
			$.each(data.response, function() {
				$.each(this, function () {
					$.each(this, function (k,v) {
						if (k == 'title') {
							$('#contenido').append('<p>Asociación: ' + v + '</p>');
						};
					});
				});
			});
		},
		dataType: 'jsonp',
		jsonp: 'json.wrf',
		error: function(xhr) {
			alert(xhr.responseText);
		} 
   });
});

});
