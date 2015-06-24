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

/* BUSQUEDA DE ASOCIACIONES*/ 
$buscar.on('click', function () {
	// eliminamos el contenido anterior
	$contenido.text("");
	$.ajax({
		type: 'GET',
		ifModified: true,
		url: $URL,
		// insertamos las variables que realizan la consulta. ATENCIÓN A LOS ESPACIOS entre elementos
		data: {'wt':'json', 'q':'title:' + $palabra.val() + ' text:' + $palabra.val() + ' AND category:Asociaciones'},
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
		data: {'wt':'json', 'q':'title:' +  $(this).text() + ' text:' +  $(this).text() + ' AND category:Asociaciones'},
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
		$.each(data.response, function() {
			$.each(this, function () {
				$.each(this, function (k,v) {		
					switch (k) {
						case 'title':
							$contenido.append('<h3>' + v + '</h3>');
							break;
						case 'direccion_s':
							$contenido.append('<p><b>Dirección: </b>' + v + '</p>');
							break;
						case 'telefono_s':
							$contenido.append('<p><b>Teléfono: </b>' + v + '</p>');
							break;
						case 'mail_s':
							$contenido.append('<p><b>Email: </b>' + v + '</p>');
							break;
						default:
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

/* BUSQUEDA DE CENTROS DE SALUD */


});
