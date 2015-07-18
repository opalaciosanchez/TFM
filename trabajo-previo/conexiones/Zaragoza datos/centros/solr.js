/// <reference path="../typings/jquery/jquery.d.ts"/>
$(function() {

// creamos las variables que vayamos a ir necesitando
// comenzamos capturando el botón que lanza la búsqueda
var $buscar = $('#buscar');
// capturamos el dato del formulario
var $palabra = $('#palabra');
// enlaces de categorias
var $categoria = $('.categoria');
// sección donde insertar el contenido
var $contenido = $('#contenido');
// URL base de la consulta
var $URL = 'http://www.zaragoza.es/buscador/select?';

/* BUSQUEDA DE CENTROS DE SALUD*/ 
$buscar.on('click', function () {
	// eliminamos el contenido anterior
	$contenido.text("");
	$.ajax({
		type: 'GET',
		ifModified: true,
		url: $URL,
		// insertamos las variables que realizan la consulta. ATENCIÓN A LOS ESPACIOS entre elementos
		data: { 'wt':'json','q':'title:Salud AND (text:' + $palabra.val() + ') AND category:Recursos' },
		success: resultados,
		dataType: 'jsonp',
		jsonp: 'json.wrf',
		error: function(xhr) {
			alert(xhr.responseText);
		} 
   });
});

// categorias
$categoria.on('click', function () {
	// eliminamos el contenido anterior
	$contenido.text("");
	$.ajax({
		type: 'GET',
		ifModified: true,
		url: $URL,
		// insertamos las variables que realizan la consulta. ATENCIÓN A LOS ESPACIOS entre elementos
		data: {'wt':'json', 'q':'title:Salud AND text:' +  $(this).text() + ' AND category:Recursos'},
		success: resultados,
		dataType: 'jsonp',
		jsonp: 'json.wrf',
		error: function(xhr) {
			alert(xhr.responseText);
		} 
   });
});

// función que muestra los resultados
function resultados(data) { 
	if (data.response.numFound !== 0) {
		// creamos la URL base para permitir la ubicación del centro de salud en el mapa
		$urlMapa = "http://maps.google.com/?q=";
		$.each(data.response, function() {
			$.each(this, function () {
				$.each(this, function (k,v) {	
					// recorremos todos los elementos del interior de este objeto y comparamos su clave con la que nos interesa
					// en caso de coincidir, obtenemos su información para nuestro uso
					switch (k) {
						case 'title':
							$contenido.append('<h3>' + v + '</h3>');
							break;
						case 'calle_t':
							$contenido.append('<p><b>Dirección: </b>' + v + '</p>');
							break;
						case 'telefono_s':
							$contenido.append('<p><b>Teléfono: </b>' + v + '</p>');
							break;
						case 'coordenadas_p':
							$contenido.append('<p><a target="_blank" href="' + $urlMapa + v + '"><button>Ubicar en mapa</button></a></p>');
							break;
					}	
					
				});
			});
		});
	} else {
		$contenido.append('<h4>No se han obtenido resultados en la búsqueda</h4>');
	}
	$palabra.val("");
}

});
