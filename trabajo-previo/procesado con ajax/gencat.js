// este fichero realiza el procesado de XML de la fuente sobre salud de la generalitat
// toda la información está en bruto, y hay que transformarla
// comenzamos haciendo la llamada mediante Ajax
$(document).ready(function () {
	$.ajax({
		url: 'http://canalsalut.gencat.cat/es/aux_/dadesobertes/llista-xml/',
		type: 'GET',
		datType: 'html',
		success: procesadoXML,
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.responseText);
        	alert(xhr.status);
        	alert(thrownError);
      	}
	});
// debemos crear la función que se llama cuando se ha realizado la conexión exitosa
function procesadoXML(datos) {

	$(datos).find("alies").each(function() {
    	$("#lista").append('<li>' + $(this).text() + "</li>");
  	});

};
});