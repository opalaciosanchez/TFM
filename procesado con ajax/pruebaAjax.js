$(document).ready(function() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "http://www.zaragoza.es/api/recurso/dataset?start=0&rows=1",
        success: function(data) {
            $.each(data, function(k,v) {
                if (k = "result") {
                    $.each($(this), function(campo,valor) {
                        $("#lista").append("<li>Campo: " + campo + " Valor: " + valor + "</li>");
                    });
                }

            });
        },
        error: function (xhr) {
             alert(xhr.responseText);
        }
    });
});