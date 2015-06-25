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
var $URL = 'http://wsearch.nlm.nih.gov/ws/query?';

/* BUSQUEDA */ 
$buscar.on('click', function () {
	// eliminamos el contenido anterior
	alert("funciona el botón");
	// $palabra.val("");
	$.ajax({
		type: 'GET',
		url: $URL,
		// insertamos las variables que realizan la consulta. ATENCIÓN A LOS ESPACIOS entre elementos
		data: {
			'db':'healthTopicsSpanish', 
			'term':'title:' + $palabra.val() 
		},
		success: resultados,
		dataType: 'jsonp xml',
		jsonp: 'json.wrf',
		error: function(jqxhr, textStatus, errorThrown)  {
        	alert("Error: " + textStatus + " : " + errorThrown)
	     }
   });
});

/* CATEGORIAS */
/*$categoria.on('click', function () {
	// eliminamos el contenido anterior
	$contenido.text("");
	$.ajax({
		type: 'GET',
		ifModified: true,
		url: $URL,
		// insertamos las variables que realizan la consulta. ATENCIÓN A LOS ESPACIOS entre elementos
		data: {
			'db':'healthTopicsSpanish', 
			'term':'title:' + $(this).text() + , 
			'rettype':'brief'
		},
		success: resultados,
		dataType: 'xml',
		error: function(xhr) {
			alert(xhr.responseText);
		} 
   });
});
*/

// función que muestra los resultados
function resultados(data) { 
	alert('conectado');
}

});
