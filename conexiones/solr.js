$(document).ready(function () {
	
	var $contenido = $("#contenido");
	var $consulta  = $("#clave").val();
	var $solr;
	
	$('#buscar').on('click', function() {
		$solr($consulta);
	});
	
	$solr = function (consulta) {
		$.ajax({
			type: "GET",
			dataType: "json",
			url: "http://www.zaragoza.es/ciudad/risp/buscar_Risp?q=asociaciones",
			success: function(datos) {
				
				$.each(datos, function (clave,valor) {
					
					$contenido.append("<h3>" + clave + "</h3>");
				
				});
			},
			error: function(xhr) {
				alert(xhr.responseText);
			}
		});
	};
	
});