/* global $ */
// este código obtiene el listado con todas propiedades del objeto 'result'
$(document).ready(function() {
	$.ajax({
		type: "GET",
		dataType: "json",
		url: "http://www.zaragoza.es/api/recurso/dataset?start=0&rows=1",
		success: function(data) {
			// data es el objeto o matriz raíz de json (las comillas externas)
			// no queremos todas la parejas clave:valor de la raíz, sino solo los datos de la clave result, que es a su vez otro objeto
			// por ello lanzamos un bucle (realmente no haría falta) que localice la propiedad result (el objeto) de la raíz
			$.each(data.result, function () {
				// al tratarse de un objeto, tiene un listado a su vez de pares k:v que queremos recorrer
				// como queremos almacenar sus valores, los pasamos como argumentos de la función para que los almacene en cada iteración
				// usamos $this para asegurarnos de que tiene en cuenta a data.result sin repetírselo
				$.each(this, function (k,v) {
					// extraemos el valor de la clave (k) y lo mostramos para obtener el listado completo de propiedades
					$("#lista").append("<li>Titulo: " + k + "</li>");
				});
			});
		},
		error: function(xhr) {
			alert(xhr.responseText);
		}
		
	});
});