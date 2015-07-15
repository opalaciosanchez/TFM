/* global $ */
$(document).ready(function() {
	$.ajax({
		type: "GET",
		dataType: "json",
		url: "http://www.zaragoza.es/api/recurso/dataset?start=0&rows=1",
		success: function(data) {
			// nos aseguramos de que se detenga sólo en la ppiedad result, un objeto de la matriz raíz (data)
			$.each(data.result, function () {
				// no queremos todas las propiedades, sino sólo dos de ellas
				// usamos la sintaxis del punto para indicar la ppiedad concreta, pero con this para evitar tener que repetir data.result
				$("#lista").append("<li>Titulo: " + this.title + "</li>");
				$("#lista").append("<li>Titulo: " + this.description + "</li>");
			});
		},
		error: function(xhr) {
			alert(xhr.responseText);
		}
		
	});
});