
function solr() {

	$.ajax({
		type: 'GET',	
		url: 'http://www.zaragoza.es/buscador/select?',
		data: {'wt':'json', 'q':'title:esclerosis AND category:Asociaciones'},
		success: function(data) { 
			$.each(data, function(k,v) {
				$('#contenido').append('<p>' + k +'</p>');
			});
		},
		dataType: 'jsonp',
		jsonp: 'json.wrf',
		error: function(xhr) {
			alert(xhr.responseText);
		} 
	});
};
