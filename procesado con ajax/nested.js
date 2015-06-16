/* global $ */
$(document).ready(function() {
	$.ajax({
		type: "GET",
		dataType: "json",
		url: "http://www.zaragoza.es/api/recurso/dataset?start=0&rows=1",
		success: function(data) {
			$.each(data.result, function () {
				$.each(this, function (k,v) {
					$("#lista").append("<li>Campo: " + k + "</li>");
				})
			});
		},
		error: function(xhr) {
			alert(xhr.responseText);
		}
		
	});
});