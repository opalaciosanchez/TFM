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
	
});



// función que muestra los resultados
function resultados(data) { 
	$contenido.text("");
	$.ajax({
		type: 'GET',
		ifModified: true,
		url: $URL,
		// insertamos las variables que realizan la consulta. ATENCIÓN A LOS ESPACIOS entre elementos
		data: {
			'db':'healthTopicsSpanish', 
			'term':'title:' + $palabra.val() + , 
			'rettype':'brief'
		},
		success: resultados,
		dataType: 'xml',
		error: function(xhr) {
			alert(xhr.responseText);
		} 
   });
}

});
