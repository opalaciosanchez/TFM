/* global $ */

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
var $URL = 'http://www.zaragoza.es/georref/json/hilo/farmacias_Equipamiento?';


/* BUSQUEDA */ 
$buscar.on('click', function () {
	// eliminamos el contenido anterior
	$contenido.text("");
	$.ajax({
		type: 'GET',
		ifModified: true,
		async:true,
		contentType: "application/javascript",
		dataType: 'jsonp',
		jsonp: 'json.wrf',
		// insertamos las variables que realizan la consulta. ATENCIÓN A LOS ESPACIOS entre elementos
		data: {'wt':'json', 'georss_deguardia':'s'},
		url: $URL,
		success: resultados,
		error: function (xhr, textStatus, thrownError) {
        	alert(xhr.status);
			alert(textStatus);
       		alert(thrownError);
		} 
   });
});

/* 
CATEGORIAS 
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
*/

// función que muestra los resultados
function resultados(data) { 
		data = $.parseJSON(data.replace(/\n/g,""));
		// alert("funciona?");
		$.each(data.features, function() {
			$.each(this, function () {
				$.each(this, function (k,v) {		
					
					$contenido.append('<p>' + k + '</p>');
				
				});
			});
		});
	
	$palabra.val("");
}

});
